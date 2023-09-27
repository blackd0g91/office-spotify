<?php

namespace App\Spotify;

class Spotify {

    public static function teste(){
        return new SpotifyRequest(
            'user', 
            'me/player'
        );
    }

    public static function search($query) {
        return new SpotifyRequest(
            'general', 
            'search',
            [
                'q' => $query,
                'type' => 'track',
                'limit' => 10,
            ]
        );
    }








    

    public static function browseNewReleases(){
        return new SpotifyRequest(
            'general', 
            'browse/new-releases'
        );
    }

    #
    # PLAYER
    #

    public static function player(){
        return new SpotifyRequest(
            'user', 
            'me/player'
        );
    }

    public static function playerNext(){
        return new SpotifyRequest(
            'user', 
            'me/player/next'
        );
    }

    public static function playerPrevious(){
        return new SpotifyRequest(
            'user', 
            'me/player/previous'
        );
    }

    public static function playerPause(){
        return new SpotifyRequest(
            'user', 
            'me/player/pause'
        );
    }

    public static function playerPlay(){
        return new SpotifyRequest(
            'user', 
            'me/player/play'
        );
    }

    public static function playerQueue(){
        return new SpotifyRequest(
            'user', 
            'me/player/queue'
        );
    }

    public static function playerPlaying(){
        return new SpotifyRequest(
            'user', 
            'me/player/currently-playing'
        );
    }

}

?>