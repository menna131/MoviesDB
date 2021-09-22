<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Setting;

class MovieController extends Controller
{
    public function index()
    {
        if(Genre::first() === Null){
            $genres_creation = new GenreController();
            $genres_creation->index();
        }
        if(Movie::first() !== Null){
            Movie::truncate();
        }
        
        $sleep_duration = Setting::get()->first()->peroid;
        $num_recorods = Setting::get()->first()->num_of_records;
        if($sleep_duration >= 60){
            sleep($sleep_duration-60);
        }
        
        $m = file_get_contents('https://api.themoviedb.org/3/discover/movie?api_key=3c9f80c1517bd84a208c3a7a86c10b44');
        $response = json_decode($m, true)['results'];
        $i=0;
        foreach ($response as $movie) {
            if($i == $num_recorods){
                break;
            }
            Movie::create([
                'backdrop_path' => $movie['backdrop_path'],
                'original_language' => $movie['original_language'],
                'original_title' => $movie['original_title'],
                'overview' => $movie['overview'],
                'poster_path' => $movie['poster_path'],
                'release_date' => $movie['release_date'],
                'title' => $movie['title'],
                'popularity' => $movie['popularity'],
                'adult' => $movie['adult'],
                'release_date' => $movie['release_date'],
                'vote_average' => $movie['vote_average'],
                'vote_count' => $movie['vote_count'],
                'video' => $movie['video'],
            ]);
            
             $latest_movie = Movie::latest('id')->first();
            foreach($movie['genre_ids'] as $genre_id){
               $latest_movie->genres()->attach($genre_id);
            }
            $i++;
        }
        return response(['message' => 'movies fetched from the movie database and stored in the database successfully']);
    }

    public function filter(Request $request)
    {
        if(!$request->has('category_id')){
            return response(['message' => 'not a valid route']);
        }
        $genre_id = $request->query('category_id');
       
        $genre_ids = Genre::pluck('id');
        $genre = Genre::find($genre_id);
        $filtered = $genre->movies()->get();
        return response($filtered);  
    }

    public function sort(Request $request)
    {
        if(!$request->has('popular') && !$request->has('rated')){
            return response(['message' => 'not a valid route']);
        }

        if($request->has('popular') && !$request->has('rated')){
            $popular = $request->query('popular');
            if($popular == 'desc'){
                $sorting_pop = Movie::get()->sortByDesc('popularity');
            }elseif($popular == 'asc'){
                $sorting_pop = Movie::get()->sortBy('popularity');
            }
            return response($sorting_pop);
        }

        elseif($request->has('rated') && !$request->has('popular')){
            $rated = $request->query('rated');
            if($rated == 'desc'){
                $sorting_rate = Movie::get()->sortByDesc('popularity');
            }elseif($rated == 'asc'){
                $sorting_rate = Movie::get()->sortBy('popularity');
            }
            return response($sorting_rate);
        }


        elseif($request->has('rated') && $request->has('popular')){
            $popular = $request->query('popular');
            if($popular == 'desc'){
                $sorting_pop = Movie::get()->sortByDesc('popularity');
            }elseif($popular == 'asc'){
                $sorting_pop = Movie::get()->sortBy('popularity');
            }
            $rated = $request->query('rated');
            if($rated == 'desc'){
                $sorting_results = collect($sorting_pop)->sortByDesc('vote_average');
            }elseif($rated == 'asc'){
                $sorting_results = collect($sorting_pop)->sortBy('vote_average');
            }
            return response($sorting_results);
        }
    }
}
