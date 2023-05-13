<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;


class ImageController extends ApiServiceController
{
    public function store(Request $request)
    {
        $imagename = time()."_".$request->file('image')->getClientOriginalName();
        request()->file('image')->storeAs('image', $imagename);
        $image = new Image();
        $image->image = $imagename;
        $image->save();
        return $this->response($image->id,'oki');
    }
}
