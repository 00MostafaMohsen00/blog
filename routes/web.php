<?php

use App\Http\Controllers\Comment\CommentController;
use App\Http\Controllers\Post\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();
Route::group(['middleware'=>'auth'],function(){
    Route::get('/dashboard', [App\Http\Controllers\Post\PostController::class, 'index'])->name('home');
    Route::resource('posts', PostController::class);
    Route::get('post/delete/{id}', [PostController::class,'destroy'])->name('posts.delete');
    Route::get('post/trash', [PostController::class,'trash'])->name('posts.trash');
    Route::get('comment/destroy/{id}', [PostController::class,'delete'])->name('post.destroy');
    Route::get('post/restore/{id}', [PostController::class,'restore'])->name('post.restore');
    Route::resource('comments', CommentController::class);
    Route::get('comment/delete/{id}', [CommentController::class,'destroy'])->name('comments.delete');
    Route::get('comment/restore/{id}', [CommentController::class,'restore'])->name('comments.restore');
});
