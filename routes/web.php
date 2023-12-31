<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\FollowingsController;
use App\Http\Controllers\Auth\RegisteredUserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [TweetController::class, 'displayDashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
Route::post('/tweets', [TweetController::class, 'store'])->name('tweets.store');
// Route::get('/show', [TweetController::class, 'show'])->name('tweets.show')->middleware('auth');
Route::delete('/tweets/{id}', [TweetController::class, 'deleteTweet'])->name('tweets.destroy');
Route::post('/search', [RegisteredUserController::class, 'searchUsers'])->name('users.search');
Route::get('/dashboard/profile', [TweetController::class, 'profileDisplay'])->name('profile.display');
Route::get('/dashboard/main', function () {return view('components.tweet.subtweetcomp');});
Route::get('/search/profile/{id}', [RegisteredUserController::class, 'displayUsers'])->name('search.profile');
Route::post('/followings', [FollowingsController::class, 'storeFollowings']);
Route::post('/get-followings-count', [FollowingsController::class, 'getFollowingsCount']);
Route::post('/get-followings', [FollowingsController::class, 'getFollowings']);
