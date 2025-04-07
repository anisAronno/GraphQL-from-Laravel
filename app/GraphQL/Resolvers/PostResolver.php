<?php

namespace App\GraphQL\Resolvers;

class PostResolver
{
    public function authorName($post, $args)
    {
        return $post->user->name;
    }
}
