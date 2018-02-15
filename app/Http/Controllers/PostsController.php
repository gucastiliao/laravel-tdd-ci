<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Transformers\PostTransformer;

class PostsController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::all();
        $posts = fractal($posts, new PostTransformer)->toArray();

        return response()->json($posts);
    }
}
