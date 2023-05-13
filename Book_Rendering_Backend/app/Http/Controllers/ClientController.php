<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Author;
use App\Models\Book;
use App\Http\Resources\clientBookResource;

class ClientController extends ApiServiceController
{
    public function search(Request $request)
    {
        $data = Book::where('name', 'LIKE', '%'.$request->filter.'%')->get();
        return $this->success( clientBookResource::collection($data));   
    }
    public function filter(Request $request)
    {
        if ($request->category) {
            $data = Book::where('category_id',$request->category)->get(); 
        }
        if ($request->author) {
            $data = Book::where('author_id',$request->author)->get(); 
        }
         return $this->success( clientBookResource::collection($data)); 
    }
    public function getCategory()
    {
        $category = Category::all();
        return $this->success($category);
    }
    public function getAuthor()
    {
        $author = Author::all();
        return $this->success($author);
    }
    public function getBook()
    {
        $book = clientBookResource::collection(Book::all());
        return $this->success($book);
    }
}
