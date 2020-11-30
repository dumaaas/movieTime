<?php

namespace App\Http\Controllers;

use App\Cast;
use App\Comment;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class LikeableController extends Controller
{
    public function likeComment($commentId, $type) {
        $comment = Comment::find($commentId);
        return auth()->user()->toggleVoteComment($comment, $type);

    }

    public function likeCast($id, $type) {
        $cast = Cast::find($id);
        auth()->user()->toggleVoteCast($cast, $type);
        return $this->showCast($cast);
    }
}
