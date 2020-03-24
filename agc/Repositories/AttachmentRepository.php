<?php

namespace Agc\Repositories;

class AttachmentRepository
{
    public function attachTo($post_id, $title, $content, $url, $filename)
    {
        $path = $this->downloadImage($url, $filename);
        $attachment_id = $this->createAttachment($post_id, $title, $content, $filename, $path);
        $this->generateThumbnail($post_id, $attachment_id);

        if (is_wp_error($attachment_id)) {
            return response()->json([
                'status' => 'error',
                'message' => $attachment_id->get_error_message()
            ], 401);
        }

        return $attachment_id;
    }

    private function downloadImage($image, $filename)
    {
        $http = new HttpRepository();
        $response = $http->get($image);

        $dir = wp_upload_dir();
        $path = $dir['path'] . '/' . $filename;

        file_put_contents($path, $response);

        return $path;
    }

    private function createAttachment($post_id, $title, $content, $filename, $path)
    {
        $dir = wp_upload_dir();
        $attachment_array = [
            'guid' => $dir['url'] . '/' . $filename,
            'post_mime_type' => 'image/jpg',
            'post_title' => $title,
            'post_excerpt' => $title,
            'post_status' => 'inherit',
            'post_content' => $content,
        ];
        $attachment_id = wp_insert_attachment($attachment_array, $path, $post_id, true);
        if (is_wp_error($attachment_id)) {
            return response()->json([
                'status' => 'error',
                'message' => $attachment_id->get_error_message()
            ], 401);
        }

        require_once(ABSPATH . 'wp-admin/includes/image.php');
        $metadata = wp_generate_attachment_metadata($attachment_id, $path);
        info('attach data', [$attachment_id, $metadata]);
        info('path', [$path]);
        wp_update_attachment_metadata($attachment_id, $metadata);

        return $attachment_id;
    }

    private function generateThumbnail($post_id, $attachment_id)
    {
        set_post_thumbnail($post_id, $attachment_id);
    }
}
