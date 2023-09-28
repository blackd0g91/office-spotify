<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Spotify\Spotify;
use Inertia\Inertia;

class QueueController extends Controller
{

    public function index () {
        $response = Spotify::playerQueue()->get();
        return Inertia::render('Queue', [
            'queue' => $response['queue'],
            'playing' => $response['currently_playing'],
        ]);
    }

    public function addTrack (Request $request) {
        $response = Spotify::queueAddTrack( [ 'uri' => 'spotify:track:'.$request->id ] )->post();
    }

    public function request () {
        return Inertia::render('Request', [
            'playing' => Spotify::playerPlaying()->get(),
        ]);
    }
}
