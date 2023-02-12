<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(Request $request, String $id) {

        $comment = new Comment();
        $comment->user_id = auth()->id();
        $comment->content = $request->input('comment');
        $comment->image_id = $id;
        $comment->save();

        return redirect()->route('dashboard');
    }

    public function delete(String $id) {
       $dbComment = Comment::where('id', $id)->first();

       if ($dbComment->user->id === auth()->id()) {
           $dbComment->delete();
       }
    }
}
