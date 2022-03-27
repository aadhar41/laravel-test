<?php

use Illuminate\Support\Facades\Route;
use App\Exceptions\UserNotFoundException;
use App\Models\User;
use App\Models\Post;

use App\Http\Controllers\PostsController;

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


Route::get('/about', function () {
    return view('about');
});

// Route::get('/post/{id}', function ($id) {
//     $post = Post::find($id);
//     return view('post', compact('post'));
// });


Route::get('/post/{id}', [PostsController::class, 'index']);

Route::get('/posts', [PostsController::class, 'showAllPosts']);

Route::get('/create-post', [PostsController::class, 'create'])->middleware('auth');

Route::post('/store-post', [PostsController::class, 'store']);


Route::get('/user', function () {

    try {
        $user = User::where(["id" => 1111])->first();
        if (!$user) {
            throw new UserNotFoundException("User not found.", 1);
        }
    } catch (UserNotFoundException $th) {
        throw new UserNotFoundException($th->getMessage(), 1);
    }
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
