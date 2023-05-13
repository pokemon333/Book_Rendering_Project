<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image;
use App\Models\File;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image_id',
        'file_id',
        'description',
        'author_id',
        'category_id',
        'book_type'
    ];
    public function author()
    {
        return $this->belongsTo(Author::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function image()
    {
        return $this->belongsTo(Image::class);
    }
    public function file()
    {
        return $this->belongsTo(File::class);
    }
}
