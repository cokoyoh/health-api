<?php

namespace App\Http\Controllers;


use App\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function addComment()
    {
        Comment::create([
            'comment' => request('comment'),
            'user_id' => Auth::user()->id,
            'post_id' => request('id')
        ]);
        return response(['message' => 'Comment added'],200);
    }

    public function updateComment($id)
    {
        $comment = Comment::find($id);
        $comment->comment = request('comment');
        $comment->save();
        return response(['message' => 'Comment updated'],200);
    }

    public function showComment($id)
    {
        $comment = Comment::find($id);
        return response(['data' => $comment],200);
    }

    public function destroyComment($id)
    {
        $comment = Comment::find($id);
        $comment->delete();
        return response(['message' => 'Comment deleted!'],200);
    }
}
