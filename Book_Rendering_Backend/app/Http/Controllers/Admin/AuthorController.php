<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ApiServiceController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author;
use Illuminate\Support\Facades\Validator;


class AuthorController extends ApiServiceController
{
      
    public function index()
    {
        $data = Author::paginate(7);
        return response()->json([
            'data' => $data,
        ]);
    }

   
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'=> 'required|string',
        ]);
        if ($validator->fails()) {
            return $this->error($validator->errors(),422);
        }else{
            $author = Author::create([
                'name' => $request->name
            ]);
            $data = Author::paginate(7);
            return response()->json([
                'data' => $data,
            ]);;
        }
    }


 
    public function update(Request $request, Author $author)
    {
        $validator = Validator::make($request->all(),[
            'name'=> 'required|string',
        ]);
        if ($validator->fails()) {
            return $this->error($validator->errors(),422);
        }else{
           $author->name = $request->name;
           $author->update();
           $data = Author::paginate(9);
           return response()->json([
               'data' => $data,
           ]);
        }
    }

   
    public function destroy(Author $author)
    {
        $author->delete();
        $data = Author::paginate(7);
        return response()->json([
            'data' => $data,
        ]);
    }
}
