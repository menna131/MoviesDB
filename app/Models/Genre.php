<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'id'
    ];

    public function movies()
    {
        return $this->belongsToMany('App\Models\Movie', 'movie_genre', 'genre_id', 'movie_id');
    }
}
