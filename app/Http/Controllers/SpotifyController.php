<?php

namespace App\Http\Controllers;

use App\Spotify\Spotify;
use App\Models\RequestedTracks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class SpotifyController extends Controller
{

    public function test () {
        // return Auth::user()->requestedTracks;
        // $data = ['spotify_id' => 'asdasd'];
        // Auth::user()->requestedTracks()->create($data);
        // dd(\App\Models\RequestedTracks::all());

        $ids = \App\Models\RequestedTracks::all();

        foreach ($ids as $id) {
            echo $id->spotify_id . "<br>";
        }
    }

    public function search ($query) {
        return Spotify::search($query)->get()->json();
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
