<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function toggleLike(String $id): void {

        $likeData = ['user_id' => auth()->id(), 'image_id' => $id];

        $likeDb = Like::where($likeData)->get();

        if (count($likeDb) === 0) {
            $like = new Like();
            $like->user_id = auth()->id();
            $like->image_id = $id;
            $like->save();

        } else {
            $likeDb[0]->delete();
        }
    }
}
