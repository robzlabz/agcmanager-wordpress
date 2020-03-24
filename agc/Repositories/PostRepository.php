<?php

namespace Agc\Repositories;

class PostRepository
{
    public function create($title, $slug, $content, $tags, $status = 'draft')
    {
        $post_array = [
            'post_content' => $content,
            'post_type' => 'post',
            'post_title' => $title,
            'post_status' => $status,
            'post_name' => $slug,
            'tags_input' => explode(',', $tags),
            'post_category' => $this->arrayCategory()
        ];

        $post_id = wp_insert_post($post_array, true);
        if (is_wp_error($post_id)) {
            return response()->error($post_id->get_error_message());
        }

        return $post_id;
    }

    private function arrayCategory()
    {
        $category = request('category');
        $categories = explode(',', $category);
        $categories = array_map('trim', $categories);

        $result = [];
        foreach ($categories as $cat) {
            $result[] = $this->updateOrCreateCategory($cat);
        }

        return $result;
    }

    function updateOrCreateCategory($name)
    {
        if (($term = get_term_by('name', $name, 'category')) != false) {
            return (int)$term->term_id;
        } else {
            $term = wp_insert_term($name, 'category');
            return $term['term_id'];
        }
    }

    public function setStatus($post_id, $status)
    {
        $post_id = wp_update_post([
            'ID' => $post_id,
            'status' => $status
        ], true);

        if (is_wp_error($post_id)) {
            return response()->error($post_id->get_error_message());
        }
        return $post_id;
    }

    public function addContent($post_id, $content)
    {
        $post_content = get_post_field('post_content', $post_id);
        $_content = $post_content . $content;

        $post_id = wp_update_post([
            'ID' => $post_id,
            'post_content' => $_content
        ], true);

        if (is_wp_error($post_id)) {
            return response()->error($post_id->get_error_message());
        }

        return $post_id;
    }

    public function count()
    {
        return wp_count_posts('post');
    }
}
