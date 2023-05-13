<?php

use App\Models\Book;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\File;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function (Request $request) {
   // Role::create(['name' => 'Silver']);
   // Role::create(['name' => 'Free']);
   // Role::create(['name' => 'Gold']);
   $user = User::where('name','admin')->first();
   // $user->syncRoles([]);
   // $user->assignRole('free');
   // $user->assignRole('silver');
   // $user->assignRole('gold');
   // $user->assignRole('admin');
   // return $user;
   // $user->assignRole('customer');
   // $book = Book::all()->pluck('image_id')->toArray();
   // $images = Image::whereNotIn('id',$book)->pluck('image');
   // Image::whereNotIn('id',$book)->delete();
   // foreach ($images as $image) {
   //    Storage::delete('image/'.$image);
   // }

   // $book = Book::all()->pluck('file_id')->toArray();
   // $files = File::whereNotIn('id',$book)->pluck('file');
   //  File::whereNotIn('id',$book)->delete();
   // foreach ($files as $file) {
   //    Storage::delete('pdf/'.$file);
   // }
   // return $files;


});
