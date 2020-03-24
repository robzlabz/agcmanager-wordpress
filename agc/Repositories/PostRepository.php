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
            return response()->json(['status' => 'error', 'message' => $post_id->get_error_message()]);
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
        // update status by post_id
    }

    public function addContent($post_id, $content)
    {
        // get current content
        // add new content
        // save content
        // return true if any changes
    }
}
