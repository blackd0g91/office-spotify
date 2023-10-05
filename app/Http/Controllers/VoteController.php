<?php

namespace App\Http\Controllers;

use App\Spotify\Spotify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class VoteController extends Controller
{
    public function voteToSkip() {

        $userId = Auth::user()->id;
        $lastVoteSongId = Cache::get('lastVoteSongId', NULL);
        $nowPlaying = Spotify::playerPlaying()->get()->json();
        $nowPlayingId = $nowPlaying->item->id;

        if($lastVoteSongId === NULL || $lastVoteSongId !== $nowPlayingId){
            Cache::forget('lastVoteSongId');
            Cache::forever('lastVoteSongId', $nowPlayingId);
            Cache::forget('votesToSkip');
        }

        $votesToSkip = Cache::get('votesToSkip', []);

        if(in_array($userId, $votesToSkip)){
            return Response::json(['message' => 'You already voted to skip this song'], 406);
        }
        $votesToSkip[] = $userId;

        if(count($votesToSkip) >= config('spotify.votes_to_skip')){
            Log::info("Song ({$nowPlaying['item']['name']}) skipped by ids: ".implode(', ', $votesToSkip));
            Cache::forget('votesToSkip');
            Spotify::playerNext()->post();

            return Response::json(['message' => 'Song Skipped']);
        } else {
            Cache::forever('votesToSkip', $votesToSkip);
            return Response::json(['message' => 'Vote to skip added']);
        }

    }
}
