<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\Process\Process;

class BackupController extends Controller
{
   public function download(Request $request)
    {
        
        $config = config('database.connections.pgsql');
        $tempDirectory = storage_path('app/temp');

        \File::ensureDirectoryExists($tempDirectory);

        putenv('TMP=' . $tempDirectory);
        putenv('TEMP=' . $tempDirectory);

        // Nombre único para la copia de seguridad
        $filename = 'clinica_sanlucas_' .
            now()->format('Y-m-d_H-i-s') . '.backup';

        $directory = storage_path('app/backups');

        File::ensureDirectoryExists($directory);

        $path = $directory . DIRECTORY_SEPARATOR . $filename;

        // Configuración de PostgreSQL
        $command = [
            env('PG_DUMP_PATH', 'pg_dump'),
            '--host=' . $config['host'],
            '--port=' . $config['port'],
            '--username=' . $config['username'],
            '--no-password',
            '--no-owner',
            '--format=custom',
            '--file=' . $path,
            $config['database'],
        ];

        try {
            $process = new Process(
                $command,
                base_path(),
                ['PGPASSWORD' => $config['password']]
            );

            $process->setTimeout(300);
            $process->mustRun();

            if (!File::exists($path) || File::size($path) === 0) {
                throw new \RuntimeException(
                    'No se generó una copia válida.'
                );
            }

            // Descargar el archivo y eliminar el temporal
            // después de enviarlo al navegador.
            return response()
                ->download($path, $filename)
                ->deleteFileAfterSend(true);

        } catch (\Throwable $e) {
            if (File::exists($path)) {
                File::delete($path);
            }

            report($e);

            return back()->with(
                'error',
                'No se pudo generar la copia de seguridad. ' .
                'Verifica la configuración de PostgreSQL.'
            );
        }
    }
}
