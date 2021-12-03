<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PostController;
use App\Models\Post;
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
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/', function () {

    $posts = Post::with('category')->take(3)->get();
    $title = 'Latest posts';

    return view('posts.index', compact('posts', 'title'));
});
Route::get('posts', [PostController::class, 'index'])->name('posts.index');
Route::get('posts/{id}', [PostController::class, 'show'])->name('posts.show');
Route::view('about', 'about')->name('about');

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::resources([
        'categories' => CategoryController::class,
        'tags' => TagController::class,
        'posts' => \App\Http\Controllers\Admin\PostController::class,
    ]);
});
