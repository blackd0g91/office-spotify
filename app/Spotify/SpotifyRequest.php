<?php

namespace App\Spotify;

class SpotifyRequest{

    private const SPOTIFY_API_URL = 'https://api.spotify.com/v1/';

    private $headers;

    public function __construct(string $type, string $endpoint, $params = [])
    {
        $this->endpoint = $endpoint;
        $this->params = $params;
        $this->headers = [
            'Content-Type' => 'application/json',
            'Accepts' => 'application/json',
            'Authorization' => 'Bearer '.SpotifyAuth::getAccessToken($type),
        ];
    }

    public function get(){
        // dd($this->params);
        try {
            $response = (new SpotifyClient)->get(self::SPOTIFY_API_URL.$this->endpoint.'?'.http_build_query($this->params), [
                'headers' => $this->headers,
            ]);
        } catch (RequestException $e) {
            $errorResponse = $e->getResponse();
            $status = $errorResponse->getStatusCode();
            $message = $errorResponse->getReasonPhrase();

            throw new Request/Exception($message, $status, $errorResponse);
        }

        return json_decode((string) $response->getBody(), true);
    }

    public function post(){
        $response = (new SpotifyClient)->post(self::SPOTIFY_API_URL.$this->endpoint, [
            'headers' => $this->headers,
            'form_params' => $this->params,
        ]);

        return json_decode((string) $response->getBody(), true);
    }

    public function put(){
        $response = (new SpotifyClient)->put(self::SPOTIFY_API_URL.$this->endpoint, [
            'headers' => $this->headers,
            'form_params' => $this->params,
        ]);

        return json_decode((string) $response->getBody(), true);
    }

}

?>