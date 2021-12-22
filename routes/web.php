<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('post/',[PostController::class,'create'])->name('post.create');
Route::post('post/',[PostController::class,'store'])->name('post.store');

Route::get('/',[PostController::class,'index'])->name('posts.index');

Route::get('post_commnet/{post_id}',[CommentController::class,'index'])->name('comment.post');
Route::post('commnet/{post_id}',[CommentController::class,'store'])->name('comment.store');


Route::post('like/{post_id}',[LikeController::class,'store'])->name('like.store');
Route::post('unlike/{post_id}',[LikeController::class,'destroy'])->name('like.delete');

require __DIR__.'/auth.php';
