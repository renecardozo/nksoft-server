<?php


namespace App\Http\Controllers;

use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


class BackupController extends Controller
{

    public function index()
    {
        try {
            $files = Storage::disk('local')->files('public/');
            $filteredFiles = array_map(function($file) {
                return str_replace('public/', '', $file);
            }, array_filter($files, function($file) {
                return basename($file) !== '.gitignore';
            }));

            rsort($filteredFiles);

            return response()->json([
                'success' => true,
                'data' => $filteredFiles
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    public function cargarBackup(Request $request)
    {
        $fileName =$request->input('filename');
        //$filePath = 'public/'.$fileName;//
        $filePath=storage_path('app/public/' . $fileName);
        // Verifica si el archivo de backup existe
        if (!Storage::disk('local')->exists('public/' . $fileName)) {
        return response()->json([
            'success'=>false,
            'message' => 'El archivo de backup no existe'], 404);
        }

        $usuario = 'admin_reservas';
        $host = 'localhost';
        $basename = 'reservas_db';
        $password = 'anaiatuya@333';


        $command = "PGPASSWORD={$password} psql -U {$usuario} -h {$host} -d {$basename} -f {$filePath}";


        $process = Process::fromShellCommandline($command);
        $process->run();

        if(!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        return response()->json([
            'success'=>true,
            'message' => 'Backup cargado correctamente']);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success'=>false,
                'message' => 'Error al cargar el backup: ' . $e->getMessage()
            ], 500);
        }
    }
    private function dropAllTablesAndSequences()
    {
        // Obtener todas las tablas
        $tables = DB::select("SELECT table_name FROM information_schema.tables WHERE table_schema = 'public' AND table_type = 'BASE TABLE'");
    
        // Eliminar todas las tablas
        foreach ($tables as $table) {
            $tableName = $table->table_name;
            DB::statement("DROP TABLE IF EXISTS $tableName CASCADE");
        }
    
        // Obtener todas las secuencias
        $sequences = DB::select("SELECT sequence_name FROM information_schema.sequences WHERE sequence_schema = 'public'");
    
       // Eliminar todas las secuencias
        foreach ($sequences as $sequence) {
            $sequenceName = $sequence->sequence_name;
            DB::statement("DROP SEQUENCE IF EXISTS $sequenceName CASCADE");
        }
    }
    private function tableExists($statement)
    {
        // Extraer el nombre de la tabla de la declaración
        preg_match('/CREATE TABLE (\w+)/', $statement, $matches);
        if (!empty($matches[1])) {
            $tableName = $matches[1];
            // Verificar si la tabla ya existe en la base de datos
            return Schema::hasTable($tableName);
        }
        return false;
    }
    public function createBackup()
    {
        // Nombre del archivo de backup
       $currentDate = Carbon::now('America/La_Paz')->format('Y-m-d_H-i-s');
       $fileName = 'backup_' . $currentDate . '.sql';
       $path = storage_path('app/public/' . $fileName);

       $sqlScript = "";

       // Obtener todas las secuencias primero
       $sequences = DB::select("SELECT sequence_name FROM information_schema.sequences WHERE sequence_schema = 'public'");
       foreach ($sequences as $sequence) {
           $sequenceName = $sequence->sequence_name;

           // Obtener el valor actual de la secuencia
           $currentValueResult = DB::select("SELECT last_value FROM $sequenceName");
           $currentValue = $currentValueResult[0]->last_value;

           // Crear el script para la secuencia
            $sqlScript .= "\nCREATE SEQUENCE $sequenceName START WITH $currentValue;\n";
       }

        // Obtener todas las tablas
        $tables = DB::select("SELECT table_name FROM information_schema.tables WHERE table_schema = 'public' AND table_type = 'BASE TABLE'");

       foreach ($tables as $table) {
           $tableName = $table->table_name;

           // Crear la estructura de la tabla
           $createTableResult = DB::select("SELECT 'CREATE TABLE ' || quote_ident(c.relname) || E'\n(\n' ||
                                           array_to_string(
                                               array_agg(
                                                   '    ' || quote_ident(a.attname) || ' ' || pg_catalog.format_type(a.atttypid, a.atttypmod) ||
                                                   CASE WHEN a.attnotnull THEN ' NOT NULL' ELSE '' END ||
                                                   CASE WHEN pg_catalog.pg_get_expr(ad.adbin, ad.adrelid) IS NOT NULL THEN ' DEFAULT ' || pg_catalog.pg_get_expr(ad.adbin, ad.adrelid) ELSE '' END
                                               ),
                                               E',\n'
                                          ) || E'\n);\n' AS create_table
                                          FROM pg_catalog.pg_attribute a
                                          JOIN pg_catalog.pg_class c ON a.attrelid = c.oid
                                          LEFT JOIN pg_catalog.pg_attrdef ad ON a.attrelid = ad.adrelid AND a.attnum = ad.adnum
                                          WHERE c.relname = :table AND a.attnum > 0 AND NOT a.attisdropped
                                          GROUP BY c.relname", ['table' => $tableName]);

           $createTableScript = $createTableResult[0]->create_table;
          $sqlScript .= "\n\n" . $createTableScript . "\n\n";

          // Obtener todos los datos de la tabla
          $rows = DB::select("SELECT * FROM $tableName");
           foreach ($rows as $row) {
               $sqlScript .= "INSERT INTO $tableName VALUES(";
               foreach ($row as $value) {
                   if (is_null($value)) {
                       $sqlScript .= "NULL, ";
                   } else {
                       $sqlScript .= "'" . addslashes($value) . "', ";
                   }
               }
               $sqlScript = substr($sqlScript, 0, -2); // Eliminar la última coma y espacio
               $sqlScript .= ");\n";
           }
          $sqlScript .= "\n";
      }
    
      // Guardar el script SQL en el archivo
      Storage::disk('local')->put('public/' . $fileName, $sqlScript);
    
      return response()->json([
           'success'=>true,
           'message' => 'Backup realizado correctamente'
       ]);
    }


    public function deleteBackup(Request $request)
    {
        $filename = $request->input('filename');
        $filePath = 'public/' . $filename;
    
        if (!Storage::disk('local')->exists($filePath)) {
            return response()->json(['error' => 'Archivo no encontrado', 'path' => $filePath], 404);
        }
        try {
            Storage::disk('local')->delete($filePath);
            return response()->json([
                'success' => true,
                'message' => 'Backup eliminado'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error al eliminar el backup'
            ], 500);
        }
    }

