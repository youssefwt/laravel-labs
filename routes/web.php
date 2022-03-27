<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PostController;

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

#list posts
Route::get("/posts", [PostController::class, "index"])->name('posts.index');

#create posts
Route::get("posts/create", [PostController::class, "create"])->name('posts.create')->middleware('auth');

Route::post("/posts", [PostController::class, "store"])->name("posts.store");

#show post
Route::get("posts/{post}", [PostController::class, "show"])->name('posts.show')->middleware('auth');

#edit
Route::get("/posts/{post}/edit", [PostController::class, "edit"])->name("posts.edit");

# update
Route::put("/post/{post}", [PostController::class, "update"])->name("posts.update");

#delete
Route::delete("/post/{post}", [PostController::class, "destroy"])->name("posts.destroy");

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/login/google', 'Auth\LoginController@redirectToProvider');
// Route::get('/login/google/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/login/google', [App\Http\Controllers\Auth\LoginController::class, 'redirectToProvider']);
Route::get('/login/google/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleProviderCallback']);
