<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Auth;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    public function likes() {
        return $this->hasMany(Like::class);
    }

    public function comment() {
        return $this->hasMany(Comment::class);
    }

    public function reminder() {
        return $this->hasMany(Remind::class);
    }

    public function favoriteCast() {
        return $this->hasMany(Favoritecast::class);
    }

    public function rating() {
        return $this->hasMany(Rating::class);
    }

    public function movielist() {
        return $this->hasMany(MovieList::class);
    }

    public function follow($id) {
        return $this->follows()->attach($id);

    }

    public function unfollow($id) {
        return $this->follows()->detach($id);
    }

    public function follows() {
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'following_user_id');
    }

    public function isInMovieList($id, $type) {
        return $this->movielist()->where('user_id', '=', Auth::user()->id)
            ->where('movie_id', '=', $id)
            ->where('type', 'LIKE', $type)->exists();
    }

    public function isFollowing(User $user) {
        return $this->follows()->where('following_user_id', $user->id)->exists();
    }

    public function isInFavorite($id) {
        return $this->favorite()->where('user_id', '=', Auth::user()->id)->where('movie_id', '=', $id)->exists();
    }

    public function isInCustom($id) {
        return $this->custom()->where('user_id', '=', Auth::user()->id)->where('movie_id', '=', $id)->exists();
    }

    public function isInWatchList($id) {
        return $this->watchlist()->where('user_id', '=', Auth::user()->id)->where('movie_id', '=', $id)->exists();
    }

    public function isInWatched($id) {
        return $this->watched()->where('user_id', '=', Auth::user()->id)->where('movie_id', '=', $id)->exists();
    }

    public function isInFavoriteCast($id) {
        return $this->favoriteCast()->where('user_id', '=', Auth::user()->id)->where('cast_id', '=', $id)->exists();
    }

    public function isAdmin() {
        if(Auth::user()->role == 'admin') {
            return true;
        } else {
            return false;
        }
    }

    public function currentUser(User $user) {
        if(Auth::user() == $user) {
            return true;
        } else {
            false;
        }
    }




    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    // protected $hidden = [
    //     'password', 'remember_token',
    // ];

    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
