<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Spotify\Spotify;
use Inertia\Inertia;

class PlayerController extends Controller
{


    public function next() {
        Spotify::playerNext()->post();
        return redirect()->action([PlayerController::class, 'playing']);
    }

    public function previous() {
        Spotify::playerPrevious()->post();
        return redirect()->action([PlayerController::class, 'playing']);
    }

    public function pause() {
        Spotify::playerPause()->put();
        return redirect()->action([PlayerController::class, 'playing']);
    }

    public function play() {
        Spotify::playerPlay()->put();
        return redirect()->action([PlayerController::class, 'playing']);
    }

    public function playing() {
        return Spotify::playerPlaying()->get()->json();
    }

    public function queue() {
        return Spotify::playerQueue()->get()->json();
    }
}
