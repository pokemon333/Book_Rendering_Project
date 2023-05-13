<?php

use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\BookController;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\FileDownloadController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\AuthController;
use App\Http\Resources\userResource;
use Illuminate\Routing\RouteGroup;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return new userResource($request->user());
});
Route::middleware('auth:sanctum','role:admin')->group(function () {
    Route::apiResource('/categories',CategoryController::class);
    Route::apiResource('/authors',AuthorController::class);
    Route::apiResource('/books',BookController::class); 
    Route::get('/alluser',[UserController::class,'allUser']);
    Route::get('role/free/{user}',[RoleController::class,'free']);
    Route::get('role/admin/{user}',[RoleController::class,'admin']);
    Route::get('role/silver/{user}',[RoleController::class,'silver']);
    Route::get('role/gold/{user}',[RoleController::class,'gold']);
}); 


Route::prefix('user')->group(function () {
    Route::post('login',[AuthController::class,'login'])->name('login');
    Route::post('logout',[AuthController::class,'logout'])->middleware('auth:sanctum');
});

// Adim Auth
Route::post('/user/register',[AuthController::class,'register']);

// Client Auth

Route::post('files',[FileController::class,'store']);
Route::post('images',[ImageController::class,'store']);

Route::get('getcategories',[ClientController::class,'getCategory']);
Route::get('getauthors',[ClientController::class,'getAuthor']);
Route::get('getproducts',[ClientController::class,'getBook']);
Route::post('search',[ClientController::class,'search']);
Route::post('filter',[ClientController::class,'filter']);
Route::get('download/{file}',[FileDownloadController::class,'download']);


