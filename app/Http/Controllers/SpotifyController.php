<?php

namespace App\Http\Controllers;

use App\Spotify\Spotify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class SpotifyController extends Controller
{

    public function test () {
        return Spotify::playerPlaying()->get();
    }



    

    public function index() {
        return Inertia::render('Dashboard');
    }

    public function search ($query) {
        return Spotify::search($query)->get();
    }

    public function register (Request $request) {

        if(Cache::get('spotifyUserCode') !== $request->code){
            Cache::flush();
            Cache::rememberForever('spotifyUserCode', function () use ($request) {
                return $request->code;
            });
        }

        return redirect()->route('player');
    }

    public function authorizeUser () {
        $clientId     = config('spotify.auth.client_id');
        return redirect('https://accounts.spotify.com/authorize?response_type=code&client_id='.$clientId.'&scope=user-modify-playback-state user-read-playback-state&redirect_uri=http://localhost:8000/spotify/authorized');
    }
}
