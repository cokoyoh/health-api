<?php

namespace App\Http\Controllers;

use App\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function showAllPosts()
    {
        $posts = Post::with('category')->orderBy('id','desc')->get();
        return response(['data' => $posts],200);
    }

    public function postsToday()
    {
        $posts_today = Post::with('categories')->where('created_at', '=', Carbon::today())
                    ->orderBy('id','desc')->get();
        return response(['data', $posts_today],200);
    }

    public function addPost()
    {
        Post::create([
            'title' => request('title'),
            'body' => request('body'),
            'user_id' => Auth::user()->id,
            'category_id' => request('category_id')
        ]);

        return response(['message' => 'New post added'],200);
    }

    public function showPost($id)
    {
        $post = Post::find($id);
        return response(['data' => $post],200);
    }

    public function updatePost($id)
    {
        $post = Post::find($id);
        $post->title = request('title');
        $post->body = request('body');
        $post->category = request('category');
        $post->save();
        return response(['message' => 'Post edited successfully'],200);
    }

    public function destroyPost($id)
    {
        $post = Post::find($id);
        $post->delete();
        return response(['message' => 'Post has been deleted!'],200);
    }
}
