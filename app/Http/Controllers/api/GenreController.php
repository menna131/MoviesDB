<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\GuzzleException;

// use Illuminate\Support\Fa;

class GenreController extends Controller
{
    public function index()
    {
        $this->store();
        $all_genres = Genre::get();
        return response(['genres' => $all_genres, 'message' => 'Genres are read from the movie database api and stored successfully in database']);
    }
    public function store()
    {
        $m = file_get_contents('https://api.themoviedb.org/3/genre/movie/list?api_key=3c9f80c1517bd84a208c3a7a86c10b44');
        $response = json_decode($m, true)['genres'];
        foreach ($response as $genre) {
            Genre::create($genre);
        }
    }
}
