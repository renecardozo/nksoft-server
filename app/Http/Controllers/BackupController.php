<?php


namespace App\Http\Controllers;

use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class BackupController extends Controller
{

    public function index()
    {
        try {
            $files = Storage::disk('public_reservas_db')->files('reservas-db');
            $namefiles = [];
            foreach ($files as $file) {
                $namefiles[] = basename($file);
            }

            rsort($namefiles);

            return response()->json([
                'success' => true,
                'data' => $namefiles
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function cargarBackup(Request $request)
    {
        $fileName = $request->input('filename');
        $filePath = storage_path('app/public/reservas-db/' . $fileName);


        if (!file_exists($filePath)) {
            return response()->json(['error' => 'El archivo no existe.'], 404);
        }
        $comando = 'backup:run --only-db --filename=' . $fileName;

        Artisan::call($comando);

        return response()->json([
            'success' => true,
            'message' => 'Backup restaurado!.'
        ]);
    }


    public function deleteBackup(Request $request)
    {
        $filename = $request->input('filename');
        $filePath = storage_path('app/public/reservas-db/' . $filename);

        if (!File::exists($filePath)) {
            return response()->json(['error' => 'Archivo no encontrado', 'path' => $filePath], 404);
        }
        try {
            File::delete($filePath);
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

    public function createBackup()
    {
        try {
           // $salida = Artisan::call('backup:run', ['--only-db' => true]);
            $comando = 'php C:\xampp\htdocs\nksoft-server\artisan backup:run --only-db';
            $salida = exec($comando);

            return response()->json([
                'success' => true,
                'message' => 'Backup creado',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
