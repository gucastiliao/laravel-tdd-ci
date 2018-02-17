<?php

namespace App\Http\Controllers;

use App\Post;
use App\Http\Requests\StorePostRequest;
use Illuminate\Http\Request;
use App\Transformers\PostTransformer;

class PostsController extends Controller
{

    /**
     * Get all posts
     *
     * @return mixed
     */
    public function index()
    {
        $posts = Post::all();
        $posts = fractal($posts, new PostTransformer)->toArray();

        return response()->json($posts);
    }

    /**
     * Store a new post
     *
     * @param StorePostRequest $request
     * @return mixed
     */
    public function store(StorePostRequest $request)
    {
        $post = Post::create($request->all());

        if ($post) {
            return $post;
        }

        return response()->json(
            [
                'error to create',
                401
            ]
        );
    }
}
