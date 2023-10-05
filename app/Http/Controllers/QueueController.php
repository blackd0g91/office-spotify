<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Spotify\Spotify;
use Inertia\Inertia;

class QueueController extends Controller
{

    public function index () {
        $response = Spotify::playerQueue()->get()->json();
        return Inertia::render('Queue', [
            'queue' => $response->queue,
            'playing' => $response->currently_playing,
        ]);
    }

    public function addTrack (Request $request) {
        Auth::user()->requestedTracks()->create(['spotify_id' => $request->id]);
        return Spotify::queueAddTrack( $request->id )->post()->json();
    }

    public function request () {
        return Inertia::render('Request', [
            'playing' => Spotify::playerPlaying()->get()->json(),
        ]);
    }
}
