<?php


namespace Agc\Repositories;


class RemoteRepository
{

    public function countItems()
    {
        return [
            'post' => (new PostRepository())->count(),
            'attachment' => (new AttachmentRepository())->count(),
            'page' => (new PageRepository())->count()
        ];
    }
}