<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovieList extends Model
{
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function movie() {
        return $this->belongsTo(Movie::class);
    }
}