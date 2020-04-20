<?php


namespace Agc\Controller;


use Agc\Repositories\PostRepository;
use Agc\Repositories\RemoteRepository;

class RemoteController
{
    private $remoteRepository;
    private $postRepository;

    public function __construct()
    {
        request()
            ->required(['func'])
            ->authenticated();

        $this->remoteRepository = new RemoteRepository();
        $this->postRepository = new PostRepository();
    }

    public function handle()
    {
        $availableFunc = ['updateStatus', 'itemsCount', 'addContent'];
        $func = request('func');
        if (!in_array($func, $availableFunc)) {
            return response()->error('Unknown Function');
        }
        $this->$func();
    }

    public function updateStatus()
    {
        request()->required(['post_id', 'status']);
        $post_id = request('post_id');
        $status = request('status');

        $post_id = $this->postRepository->setStatus($post_id, $status);

        return response()->success(
            sprintf("Post #%s updated", $post_id)
        );
    }

    public function itemsCount()
    {
        $data = $this->remoteRepository->countItems();

        return response()->json([
            'message' => 'count of page, post and attachment',
            'data' => $data
        ]);
    }

    public function addContent()
    {
        request()->required(['post_id', 'content']);
        $post_id = request('post_id');
        $content = request('content');

        $post_id = $this->postRepository->addContent($post_id, $content);

        return response()->success(
            sprintf("Post #%d updated", $post_id)
        );
    }
}
