<?php


namespace Agc\Repositories;


class RouteRepository
{
    public static function add($name, $class)
    {
        $key = 'wp_ajax_nopriv_agc_' . $name;
        add_action($key, function () use ($class) {
            (new $class)->handle();
        });

        $key = 'wp_ajax_agc_' . $name;
        add_action($key, function () use ($class) {
            (new $class)->handle();
        });
    }
}