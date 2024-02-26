<?php

namespace App\Services\Utility;

use Alert;
use Artisan;
use Storage;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\StreamedResponse;

class BackupService
{
    public function lists(){
        $files = Storage::files('STSIMS');
        $fileDetails = collect($files)->map(function ($file) {
            return [
                'name' => basename($file),
                'path' => $file,
                'size' => $this->formatSizeUnits(Storage::size($file)),
                // 'url' => route('file.show', ['filename' => basename($file)]),
                'date' => Carbon::createFromTimestamp(Storage::lastModified($file))->format('M d, Y g:i a'),
            ];
        })->sortByDesc(function ($file) {
            return $file['date'];
        })->values();
        return $fileDetails->toJson();
    }

    public function download($filename){
        $filePath = '/app/STSIMS/' . $filename;
        return $this->streamFile($filePath);
    }

    private function streamFile($filePath){
        return new StreamedResponse(function () use ($filePath) {
            $stream = fopen(storage_path($filePath), 'rb');
            while (!feof($stream)) {
                echo fread($stream, 1024);
            }
            fclose($stream);
        }, 200, [
            'Content-Type' => mime_content_type(storage_path($filePath)),
            'Content-Disposition' => 'attachment; filename="' . basename($filePath) . '"',
        ]);
    }

    function formatSizeUnits($bytes){
        $units = array('B', 'KB', 'MB', 'GB', 'TB');
        $i = 0;
        while ($bytes >= 1024 && $i < count($units) - 1) {
            $bytes /= 1024;
            $i++;
        }
        return round($bytes, 2) . ' ' . $units[$i];
    }

    public function generate(){
        return $data = Artisan::call('backup:run --only-db');
    }
}
