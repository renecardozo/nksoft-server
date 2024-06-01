<?php


namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Backup;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class BackupController extends Controller
{

    public function index()
    {
        try {
            $files = Storage::disk('public')->files();
            $filteredFiles = array_filter($files, function($file) {
                return basename($file) !== '.gitignore';
            });
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
        $fileName = $request->input('filename');
        $filePath = storage_path('app/public/' . $fileName);


        if (!file_exists($filePath)) {
            return response()->json(['error' => 'El archivo no existe.'], 404);
        }

        $usuario = 'postgres';
        $host = 'localhost';
        $basename = 'reservas';
        $password = 'postgres';


        $command = "PGPASSWORD={$password} psql -U {$usuario} -h {$host} -d {$basename} -f {$filePath}";


        $process = Process::fromShellCommandline($command);
        $process->run();

        if(!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        return response()->json([
            'success'=>true,
            'message' => 'Backup restaurado!.'
        ]);

    }

    public function deleteBackup(Request $request)
    {
        $filename = $request->input('filename');

        $filePath = storage_path('app/public/' . $filename);
        if (!File::exists($filePath)) {
            return response()->json(['error' => 'Archivo no encontrado'], 404);
        }
        try {
            File::delete($filePath);
            return response()->json([
                'success' => true,
                'message'=>'Backup eliminado'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success'=>false,
                'error' => 'Error al eliminar el backup'
            ], 500);
        }
    }
    public function createBackup()
    {
        $usuario = 'postgres';
        $host = 'localhost';
        $basename = 'reservas';
        $password = 'postgres';

       /* $directorio = '/storage/app/public/backup';

        if (!File::exists($directorio)) {
            File::makeDirectory($directorio);
        }

        if (File::isWritable($directorio)) {
            File::chmod($directorio, 0775);
        } else {
            // Maneja los problemas de permisos
        }
        */
        $currentDate = Carbon::now('America/La_Paz')->format('Y-m-d-H:i:s');

        $backupPath = storage_path('app/public/'.$currentDate.'_backup.sql');

        $command = "PGPASSWORD={$password} pg_dump -U {$usuario} -h {$host} {$basename} > {$backupPath}";

        // Ejecuta el comando
        $process = Process::fromShellCommandline($command);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        return response()->json([
            'success'=>true,
            'message' => 'Backup creado.'
        ]);
    }
}
