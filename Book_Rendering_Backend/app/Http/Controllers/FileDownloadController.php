<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileDownloadController extends Controller
{
    public function download($file)
    {
       $path = storage_path('app/pdf/'.$file);
       $headers = [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'attachment; filename="' . $file . '"',
        ];
       return response()->download($path,'oki',$headers);
    }
}
