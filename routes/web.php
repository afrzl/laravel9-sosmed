<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', \App\Http\Controllers\TimelineController::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::post('post', \App\Http\Controllers\Post\StorePostController::class)->name('post.store');
Route::get('post/{post}', \App\Http\Controllers\Post\ShowPostController::class)->name('post.show');
Route::post('post/{post}/comment', \App\Http\Controllers\Post\StoreCommentController::class)->name('post.comment.store');

require __DIR__ . '/auth.php';
