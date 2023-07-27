<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CategoriesController;
// use App\Http\Controllers\AuthorController;
use App\Http\Controllers\API\AuthorController;
use App\Http\Controllers\API\UsersController;
// use App\Http\Controllers\AuthorController;
// use App\Http\Controllers\BookController;
// use App\Http\Controllers\API\AuthorController;
use App\Http\Controllers\API\BookController;
// use App\Models\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//categories
// Route::get('/categories', [CategoriesController::class, 'index']);
// Route::get('/categories/{id}', [CategoriesController::class, 'show']);
// Route::post('/categories', [CategoriesController::class, 'store']);
// Route::put('/categories/{id}', [CategoriesController::class, 'update']);
// Route::delete('/categories/{id}', [CategoriesController::class, 'destroy']);



// Route::middleware(['admin-access','superAdmin-access'])->group(function () {
//     // Route::put('/users/{id}', [UsersController::class, 'update']);

// Route::get('/categories', [CategoriesController::class, 'index']);//viewer
// Route::get('/categories/{id}', [CategoriesController::class, 'show']);
// Route::post('/categories', [CategoriesController::class, 'store']);
// Route::put('/categories/{id}', [CategoriesController::class, 'update']);
// Route::delete('/categories/{id}', [CategoriesController::class, 'destroy']);

// Route::get('/authors', [AuthorController::class, 'index']);
// Route::post('/authors', [AuthorController::class, 'store']);
// Route::get('/authors/{id}', [AuthorController::class, 'show']);
// Route::put('/authors/{id}', [AuthorController::class, 'update']);
// Route::delete('/authors/{id}', [AuthorController::class, 'destroy']);



// });

Route::middleware('viewer-access')->group(function () {
    
Route::get('/categories', [CategoriesController::class, 'index']);//viewer
Route::get('/categories/{id}', [CategoriesController::class, 'show']);

Route::get('/authors', [AuthorController::class, 'index']);
Route::get('/authors/{id}', [AuthorController::class, 'show']);


});



Route::apiResource('users','App\Http\Controllers\API\UsersController')->middleware('superAdmin-access');
//register
Route::post('create',[App\Http\Controllers\API\AuthController::class,'create'])->middleware('superAdmin-access');

// Route::apiResource('users','App\Http\Controllers\API\UsersController');

// Route::apiResource(, )->middleware('superAdmin-access');

Route::prefix('books')->controller(BookController::class)->group(function(){
    Route::get('/','index');
    Route::get('/show','show');
    
    Route::middleware('superAdmin-access')->group(function(){
        Route::post('/','store');
        Route::put('/{id}','update');
        Route::delete('/{id}','destroy');
        Route::put('/restore/{id}', [BookController::class, 'restore']);
    });

    Route::middleware('admin-access')->group(function(){
        Route::post('/','store');
        Route::put('/{id}','update');
        Route::delete('/{id}','destroy');
    });

   
});
//register
Route::post('create', [App\Http\Controllers\API\AuthController::class, 'create']);
//login
Route::post('login', [App\Http\Controllers\API\AuthController::class, 'login']);
//update
// Route::PUT(`/user/update/{$id}`,[App\Http\Controllers\API\UsersController::class,'update']);
// Route::get('/authors', [AuthorController::class, 'index']);
// Route::post('/authors', [AuthorController::class, 'store']);
// Route::get('/authors/{id}', [AuthorController::class, 'show']);
// Route::put('/authors/{id}', [AuthorController::class, 'update']);
// Route::delete('/authors/{id}', [AuthorController::class, 'destroy']);



Route::middleware('superAdmin-access')->group(function () {
   Route::get('/categories', [CategoriesController::class, 'index']);//viewer
Route::get('/categories/{id}', [CategoriesController::class, 'show']);
Route::post('/categories', [CategoriesController::class, 'store']);
Route::put('/categories/{id}', [CategoriesController::class, 'update']);
Route::delete('/categories/{id}', [CategoriesController::class, 'destroy']);

Route::get('/authors', [AuthorController::class, 'index']);
Route::post('/authors', [AuthorController::class, 'store']);
Route::get('/authors/{id}', [AuthorController::class, 'show']);
Route::put('/authors/{id}', [AuthorController::class, 'update']);
Route::delete('/authors/{id}', [AuthorController::class, 'destroy']);
});



Route::middleware('admin-access')->group(function () {
    Route::get('/categories', [CategoriesController::class, 'index']);//viewer
    Route::get('/categories/{id}', [CategoriesController::class, 'show']);
    Route::post('/categories', [CategoriesController::class, 'store']);
    Route::put('/categories/{id}', [CategoriesController::class, 'update']);
    Route::delete('/categories/{id}', [CategoriesController::class, 'destroy']);
    
    Route::get('/authors', [AuthorController::class, 'index']);
    Route::post('/authors', [AuthorController::class, 'store']);
    Route::get('/authors/{id}', [AuthorController::class, 'show']);
    Route::put('/authors/{id}', [AuthorController::class, 'update']);
    Route::delete('/authors/{id}', [AuthorController::class, 'destroy']);
});

