<?php

namespace App\Http\Controllers;

use App\Spotify\Spotify;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index() {
        return Inertia::render('Admin', [
            'playing' => Spotify::playerPlaying()->get(),
        ]);
    }
}
