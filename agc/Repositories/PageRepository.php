<?php


namespace Agc\Repositories;


class PageRepository
{
    public function create($title, $content)
    {

    }

    public function count()
    {
        return wp_count_posts('page');
    }
}