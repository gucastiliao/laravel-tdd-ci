<?php

namespace App\Transformers;

use App\Post;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class PostsTransformer extends TransformerAbstract
{
    public function transform(Post $post)
    {
        return [
            'id' => (int) $post->id,
            'title' => $post->title,
            'body' => $post->body,
            'author' => $post->author,
            'created_at' => $post->created_at->format('d/m/Y H:i'),
            'updated_at' => $post->created_at->format('d/m/Y H:i'),
        ];
    }
}