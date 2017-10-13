<?php

namespace App\Http\Controllers;

use App\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function showAllPosts()
    {
        $posts = Post::with('category')->orderBy('id', 'desc')->get();
        return response(['data' => $posts], 200);
    }

    public function showLatestPost()
    {
        $lates_post = Post::with('category')->orderBy('id', 'desc')->first();
        return response(['data' => $lates_post], 200);
    }

    public function showFitnessPosts()
    {
        $fitness_posts = Post::where('category_id', '=', 2)->orderBy('id','desc')->get();
        return response(['data' => $fitness_posts],200);
    }

    public function showMedicinePosts()
    {
        $medicine_posts = Post::where('category_id', '=', 1)->orderBy('id','desc')->get();
        return response(['data' => $medicine_posts],200);
    }

    public function showDiseasesPosts()
    {
        $diseases_posts = Post::where('category_id', '=', 3)->orderBy('id','desc')->get();
        return response(['data' => $diseases_posts],200);
    }

    public function postsToday()
    {
        $posts_today = Post::with('categories')->where('created_at', '=', Carbon::today())
            ->orderBy('id', 'desc')->get();
        return response(['data', $posts_today], 200);
    }

    public function addPost()
    {
        $exploded = explode(',', request('image'));
        $decoded = base64_decode($exploded[1]);
        if (str_contains($exploded[0], 'jpeg'))
        {
            $extension = 'jpg';
        } else
            $extension = 'png';
        $file_name = time() . '.' . $extension;

        $path = public_path('/uploads/posts-images/' . $file_name);
        file_put_contents($path, $decoded);

        Post::create([
            'title' => request('title'),
            'body' => request('body'),
            'summary' => request('summary'),
            'image' => $file_name,
            'user_id' => Auth::user()->id,
            'category_id' => request('category_id')
        ]);

        return response(['message' => 'New article has been successfully added'], 200);
    }

    public function showPost($id)
    {
        $post = Post::find($id);
        return response(['data' => $post], 200);
    }

    public function updatePost($id)
    {
        $post = Post::find($id);
        $post->title = request('title');
        $post->body = request('body');
        $post->category = request('category');
        $post->save();
        return response(['message' => 'Post edited successfully'], 200);
    }

    public function showPostComment($id)
    {
        $post = Post::with('comments')->where('id', '=', $id)->get();
        return response(['data' => $post], 200);
    }

    public function destroyPost($id)
    {
        $post = Post::find($id);
        $post->delete();
        return response(['message' => 'Post has been deleted!'], 200);
    }
}
