<?php

use App\Http\Controllers\SpotifyController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\QueueController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware('auth')->group(function () {
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->middleware('verified')->group(function () {

    Route::get('test',                  [SpotifyController::class, 'test'])->name('test');

    // Pages
    Route::get('dashboard',             fn() => Inertia::render('Dashboard'))->name('dashboard');
    Route::get('admin',                 [AdminController::class, 'index'])->name('admin');
    Route::get('queue',                 [QueueController::class, 'index'])->name('queue');
    Route::get('request',               [QueueController::class, 'request'])->name('request');
    
    // Player Authorization
    Route::get('spotify/authorize',     [SpotifyController::class, 'authorizeUser']);
    Route::get('spotify/authorized',    [SpotifyController::class, 'register']);

    // Actions
    Route::get('player/playing',        [PlayerController::class, 'playing'])->name('player.playing');
    Route::get('player/queue',          [PlayerController::class, 'queue'])->name('player.queue');
    Route::post('player/previous',      [PlayerController::class, 'previous'])->name('player.previous');
    Route::post('player/next',          [PlayerController::class, 'next'])->name('player.next');
    Route::post('player/pause',         [PlayerController::class, 'pause'])->name('player.pause');
    Route::post('player/play',          [PlayerController::class, 'play'])->name('player.play');
    Route::get('search/{q}',            [SpotifyController::class, 'search'])->name('search');
    Route::post('queue/track',          [QueueController::class, 'addTrack'])->name('queue.track.add');

    // Voting
    Route::post('vote/skip',            [VoteController::class, 'voteToSkip'])->name('vote.skip');

});

require __DIR__.'/auth.php';
