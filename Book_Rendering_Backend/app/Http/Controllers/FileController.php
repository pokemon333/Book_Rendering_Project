<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\File;

class FileController extends  ApiServiceController
{
    public function store(Request $request)
    {
        $filename = time()."_".$request->file('file')->getClientOriginalName();
        request()->file('file')->storeAs('pdf', $filename);
        $file = new File();
        $file->file = $filename;
        $file->save();
        return $this->response($file->id,'oki');
    }
}
