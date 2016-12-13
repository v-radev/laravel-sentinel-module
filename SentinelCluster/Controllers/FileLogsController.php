<?php

namespace App\Clusters\SentinelCluster\Controllers;

class FileLogsController extends SentinelClusterController
{

    public function index()
    {
        $directoryIterator = new \RecursiveDirectoryIterator(storage_path() .'/logs/');
        $iterator = new \RecursiveIteratorIterator($directoryIterator);
        $ignoredFiles = ['laravel.log', '.gitignore'];
        $linesToRead = 50;
        $logs = [];

        foreach ( $iterator as $filePath => $fileObject ) {
            $fileName = $fileObject->getFileName();

            if ( in_array($fileName, $ignoredFiles) ) {
                continue;
            }

            if ( $fileObject->isFile() ) {
                $file = fopen($filePath, 'r');
                $lines = [];

                while( !feof($file) )
                {
                    $line = fgets($file, 4096);
                    array_push($lines, $line);

                    if ( count($lines) > $linesToRead) {
                        array_shift($lines);
                    }
                }

                $logs[$fileName] = $lines;
            }
        }

        return $this->view('file_logs.index', compact('logs'));
    }
}
