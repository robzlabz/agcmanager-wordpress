<?php

namespace Agc\Controller;

use Agc\Repositories\PostRepository;

class PostController
{
    /**
     * @var PostRepository
     */
    private $postRepository;

    public function __construct()
    {
        request()
            ->required(['token', 'title', 'slug', 'content', 'status', 'tags', 'category'])
            ->authenticated();

        $this->postRepository = new PostRepository();
    }

    public function handle()
    {
        $title = request('title');
        $slug = request('slug');
        $content = request('content');
        $status = request('status');
        $tags = request('tags');

        $post_id = $this->postRepository->create($title, $slug, $content, $tags, $status);

        return response()->json([
            'status' => 'success',
            'message' => sprintf("post #%d is created", $post_id),
            'post_id' => $post_id
        ]);
    }
}
