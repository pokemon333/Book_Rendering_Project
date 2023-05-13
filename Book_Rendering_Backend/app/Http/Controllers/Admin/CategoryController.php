<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\ApiServiceController;

class CategoryController extends ApiServiceController
{
   
    public function index()
    {
        $data = Category::paginate(9);
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
            $category = Category::create([
                'name' => $request->name
            ]);
            $data = Category::paginate(9);
            return response()->json([
                'data' => $data,
            ]);
        }
    }

   
    public function show(Category $category)
    {
        return $this->success($category);
    }

 
    public function update(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(),[
            'name'=> 'required|string',
        ]);
        if ($validator->fails()) {
            return $this->error($validator->errors(),422);
        }else{
           $category->name = $request->name;
           $category->update();
           $data = Category::paginate(9);
           return response()->json([
               'data' => $data,
           ]);
        }
    }

   
    public function destroy(Category $category)
    {
        $category->delete();
        $data = Category::paginate(9);
        return response()->json([
            'data' => $data,
        ]);
    }

}
