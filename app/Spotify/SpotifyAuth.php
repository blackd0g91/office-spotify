<?php

namespace App\Spotify;

// use Aerni\Spotify\Exceptions\SpotifyAuthException;
// use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Cache;
// use SpotifyClient;

class SpotifyAuth
{
    private const SPOTIFY_API_TOKEN_URL = 'https://accounts.spotify.com/api/token';

    private static function generateAccessToken($type): void
    {
        $clientId     = config('spotify.auth.client_id');
        $clientSecret = config('spotify.auth.client_secret');
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Accepts' => 'application/json',
            'Authorization' => 'Basic '.base64_encode($clientId.':'.$clientSecret),
        ];

        try {
            if($type === 'general'){
                $response = (new SpotifyClient)->post(self::SPOTIFY_API_TOKEN_URL, [
                    'headers' => $headers,
                    'form_params' => [
                        'grant_type' => 'client_credentials',
                    ],
                ]);

                $body = json_decode((string) $response->getBody());

                Cache::remember('spotifyGeneralToken', $body->expires_in, function () use ($body) {
                    return $body->access_token;
                });

            } else if($type === 'user') {

                if(Cache::has('spotifyRefreshToken')) {
                    var_dump('refresh');
                    $response = (new SpotifyClient)->post(self::SPOTIFY_API_TOKEN_URL, [
                        'headers' => $headers,
                        'form_params' => [
                            'grant_type' => 'refresh_token',
                            'refresh_token' => Cache::get('spotifyRefreshToken')
                        ],
                    ]);

                } else {
                    $response = (new SpotifyClient)->post(self::SPOTIFY_API_TOKEN_URL, [
                        'headers' => $headers,
                        'form_params' => [
                            'grant_type' => 'authorization_code',
                            'code' => Cache::get('spotifyUserCode'),
                            'redirect_uri' => 'http://localhost:8000/spotify/authorized'
                        ],
                    ]);
    
                }

                $body = json_decode((string) $response->getBody());
    
                Cache::remember('spotifyUserToken', $body->expires_in, function () use ($body) {
                    return $body->access_token;
                });

                if(isset($body->refresh_token)){
                    Cache::rememberForever('spotifyRefreshToken', function () use ($body) {
                        return $body->refresh_token;
                    });
                }


            }

            // var_dump(json_decode((string) $response->getBody()));

        } catch (RequestException $e) {
            // $errorResponse = json_decode($e->getResponse()->getBody()->getContents());
            // $status = $e->getCode();
            // $message = $errorResponse->error;

            throw new RequestException($message, $status, $errorResponse);
        }


    }

    public static function getAccessToken(string $type): string
    {

        if($type == 'general') {
            $tokenName = 'spotifyGeneralToken';
        } else {
            $tokenName = 'spotifyUserToken';
        }

        if (! Cache::has($tokenName)) {
            self::generateAccessToken($type);
        }

        return Cache::get($tokenName);
    }
}