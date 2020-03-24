<?php

namespace Agc\Controller;

use Agc\Repositories\AttachmentRepository;

class AttachmentController
{
    private $attachmentRepository;

    public function __construct()
    {
        request()
            ->required(['token', 'title', 'slug', 'content', 'image', 'filename'])
            ->authenticated();

        $this->attachmentRepository = new AttachmentRepository();
    }

    public function handle()
    {
        $post_id = request('post_id');
        $title = request('title');
        $content = request('content');
        $image = request('image');
        $filename = request('filename');

        $attachment_id = $this->attachmentRepository->attachTo($post_id, $title, $content, $image, $filename);

        return response()->json([
            'status' => 'success',
            'message' => sprintf("Attachment #%d is created", $attachment_id),
            'attachment_id' => $post_id
        ]);
    }
}
