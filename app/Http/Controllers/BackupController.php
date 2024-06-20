<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

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
        $filePath = 'public/'.$fileName;//
       // $filePath=storage_path('app/public/' . $fileName);

        // Verifica si el archivo de backup existe
        if (Storage::exists($filePath)) {
            $sqlStatements = explode(";", Storage::get($filePath));
            $totalErrors = 0;
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
            foreach ($sqlStatements as $statement) {
                $statement = trim($statement);
                if (!empty($statement)) {
                    try {
                        DB::statement($statement . ';');
                    } catch (\Exception $e) {
                        $totalErrors++;
                    }
                }
            }
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
            if ($totalErrors <= 0) {
                return response()->json([
                    'success' => true,
                    'message' => 'Restauración completada con éxito'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Ocurrió un error inesperado, no se pudo hacer la restauración completamente'
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'El archivo de backup no existe'
            ]);
        }

    }

    public function createBackup()
    {
       $currentDate = Carbon::now('America/La_Paz')->format('Y-m-d_H-i-s');

        // Verificar si se puede obtener el nombre de la base de datos
        try {
            $databaseName = DB::getDatabaseName();
        } catch (\Exception $e) {
            return response()->json([
                'success'=>false,
                'message' => 'No se pudo establecer la conexión a la base de datos'
            ]);
        }

        // Obtener el nombre del archivo de backup
        $backupName =  'backup_' . $currentDate . '.sql';

        // Iniciar la construcción del archivo SQL
        $sql = "-- Respaldo de la base de datos $databaseName\n\n";

        // Agregar configuraciones iniciales
        $sql .= <<<EOL
    /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
    /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
    /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
    /*!40101 SET NAMES utf8mb4 */;
    /*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
    /*!40103 SET TIME_ZONE='+00:00' */;
    /*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
    /*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
    /*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
    /*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
    EOL;

        // Obtener el listado de tablas en la base de datos
        $tables = DB::select('SHOW TABLES');

        foreach ($tables as $table) {
            $tableName = reset($table);

            // Agregar comando para eliminar la tabla si existe
            $sql .= "DROP TABLE IF EXISTS `$tableName`;\n";

            $tableInfo = DB::select("SHOW CREATE TABLE $tableName");

            // Agregar comando para crear la tabla de nuevo
            $sql .= "/*!40101 SET @saved_cs_client = @@character_set_client */;\n";
            $sql .= "/*!40101 SET character_set_client = utf8 */;\n";
            $sql .= $tableInfo[0]->{'Create Table'} . ";\n";
            $sql .= "/*!40101 SET character_set_client = @saved_cs_client */;\n";

            // Bloquear la tabla antes de insertar datos
            $sql .= "LOCK TABLES `$tableName` WRITE;\n";
            $sql .= "/*!40000 ALTER TABLE `$tableName` DISABLE KEYS */;\n";

            // Agregar los datos de la tabla al archivo SQL
            $tableData = DB::table($tableName)->get()->toArray();
            foreach ($tableData as $row) {
                $sql .= "INSERT INTO `$tableName` VALUES (";

                // Formatear manualmente cada fila de datos
                foreach ($row as $key => $value) {
                    // Si el valor es una cadena, escapar comillas
                    if (is_string($value)) {
                        $value = addslashes($value);
                        $value = "'$value'";
                    } elseif (is_null($value)) {
                        $value = 'NULL';
                    }
                    $sql .= "$value, ";
                }
                // Eliminar la última coma y espacio
                $sql = rtrim($sql, ', ');
                $sql .= ");\n";
            }

            // Desbloquear la tabla después de insertar datos
            $sql .= "/*!40000 ALTER TABLE `$tableName` ENABLE KEYS */;\n";
            $sql .= "UNLOCK TABLES;\n\n";
        }

        // Agregar configuraciones finales
        $sql .= <<<EOL
    /*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
    /*!40114 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
    /*!40101 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
    /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
    /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
    /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
    /*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
    /*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
    EOL;

      // Guardar el script SQL en el archivo
      Storage::disk('local')->put('public/' . $backupName, $sql);
    
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
}