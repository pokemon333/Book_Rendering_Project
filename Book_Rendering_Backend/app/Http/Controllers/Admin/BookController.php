<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ApiServiceController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Book;
use App\Http\Resources\bookResource;

class BookController extends ApiServiceController
{
   
    public function index(Request $request)
    {
        $data = bookResource::collection( Book::paginate(9))->resource;
        return response()->json([
            'data' => $data,
        ]);
    }

   
    public function store(Request $request)
    {
        $messages = array(
            'author_id.required' => 'The author field is required',
            'category_id.required' => 'The category field is required',
            'file_id.required' => 'Choose book.pdf file for the book',
            'image_id.required' => 'Choose an image for the book',
        );
        $validator = Validator::make($request->all(),[
            'name'=> 'required|string',
            'image_id'=> 'required',
            'file_id'=> 'required',
            'description'=> 'required|string',
            'author_id'=> 'required',
            'category_id'=> 'required',
            'book_type'=> 'required|string',

        ],$messages);
        if ($validator->fails()) {
            return $this->error($validator->errors(),422);
        }else{
            $book = Book::create($request->all());
            $data = bookResource::collection( Book::paginate(9))->resource;
            return response()->json([
                'data' => $data,
            ]);;
        }
    }

    public function update(Request $request,Book $book)
    {
        $messages = array(
            'author_id.required' => 'The author field is required',
            'category_id.required' => 'The category field is required',
            'file_id.required' => 'Choose book.pdf file for the book',
            'image_id.required' => 'Choose an image for the book',
        );
        $validator = Validator::make($request->all(),[
            'name'=> 'required|string',
            'image_id'=> 'required',
            'file_id'=> 'required',
            'description'=> 'required|string',
            'author_id'=> 'required',
            'category_id'=> 'required',
            'book_type'=> 'required|string',

        ],$messages);
        if ($validator->fails()) {
            return $this->error($validator->errors(),422);
        }else{
            $book->name = $request->name;
            $book->image_id = $request->image_id;
            $book->file_id = $request->file_id;
            $book->description = $request->description;
            $book->author_id = $request->author_id;
            $book->category_id = $request->category_id;
            $book->book_type = $request->book_type;
            $book->update();
            $data = bookResource::collection( Book::paginate(9))->resource;
            return response()->json([
                'data' => $data,
            ]);;
        }
    }

    public function destroy(Book $book)
    {
        $book->delete();
        $data = bookResource::collection( Book::paginate(9))->resource;
        return response()->json([
            'data' => $data,
        ]);
    }
 
}
