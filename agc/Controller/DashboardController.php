<?php

namespace Agc\Controller;

use Agc\Repositories\TokenRepository;

class DashboardController
{
    public function handle()
    {
        add_action('admin_menu', [$this, 'build']);
    }

    public function build()
    {
        add_menu_page('AGC Manager', 'AGC Manager', 'manage_options', 'agcmanager_index', [$this, 'index'], null, 99);
    }

    public function index()
    {
        $repo = new TokenRepository();

        if (request()->has('change')) {
            $new_token = $repo->generate();
            $repo->set($new_token);
        }
        $token = $repo->get();
        include __DIR__ . '/../Views/index.php';
    }
}
