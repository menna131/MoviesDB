<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'adult',
        'backdrop_path',
        'original_language',
        'original_title',
        'overview',
        'popularity',
        'poster_path',
        'release_date',
        'title',
        'video',
        'vote_average',
        'vote_count',
    ];
    public function genres()
    {
        return $this->belongsToMany('App\Models\Genre', 'movie_genre', 'movie_id', 'genre_id');
    }
}
