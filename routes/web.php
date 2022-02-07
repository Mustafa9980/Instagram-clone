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
use App\Mail\NewUserWelcomeMail;


Auth::routes();

Route::get('/email', function () {
    return new NewUserWelcomeMail();
});
//  Route::post('comments', [App\Http\Controllers\CommentController::class, 'store']);
//  Route::resource('comments', [App\Http\Controllers\CommentController::class, 'store' ]);


Route::post('Follow/{user}', [App\Http\Controllers\FollowsController::class, 'store']);

Route::get('/', [App\Http\Controllers\PostsController::class, 'index'])->name('post.index');
Route::get('/p/create', [App\Http\Controllers\PostsController::class, 'create']);
Route::delete('/p/{post}',[App\Http\Controllers\PostsController::class, 'destroy'])->name('post.destroy');
Route::post('like/{like}', [App\Http\Controllers\LikeController::class, 'create'])->name('like.create');
Route::get('/explore', [App\Http\Controllers\PostsController::class,'explore'])->name('post.explore'); // Explore Page
Route::get('/p/{post}', [App\Http\Controllers\PostsController::class, 'show'])->name('post.show');
Route::post('/p', [App\Http\Controllers\PostsController::class, 'store']);
//profile


Route::get('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'index'])->name('profile.show');
Route::get('/profile/{user}/edit', [App\Http\Controllers\ProfilesController::class, 'edit'])->name('profile.edit');
Route::patch('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'update'])->name('profile.update');
Route::any('/search', [App\Http\Controllers\ProfilesController::class, 'search'])->name('profile.search'); // Search Page




 Route::post('/comment/store', [App\Http\Controllers\CommentController::class, 'store'])->name('comment.add');
// Stories Route
Route::get('/stories/create', [App\Http\Controllers\StoryController::class, 'create'])->name('stories.create');
Route::get('/stories/{user}', [App\Http\Controllers\StoryController::class, 'show'])->name('stories.show');
Route::post('/stories', [App\Http\Controllers\StoryController::class, 'store'])->name('stories.store');


// Route::get('/stories/create', 'StoryController@create')->name('stories.create');

// Route::get('/stories/{user}', 'StoryController@show')->name('stories.show');

// Route::post('/stories', 'StoryController@store')->name('stories.store');
