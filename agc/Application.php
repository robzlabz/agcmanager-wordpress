<?php

namespace Agc;

use Agc\Controller\AttachmentController;
use Agc\Controller\PostController;
use Agc\Controller\VerifyController;
use Agc\Repositories\RouteRepository as Route;
use Agc\Repositories\TokenRepository;

class Application
{
    private $error_message;

    public function registerRoutes()
    {
        $route = new Route();
        $route->add('verify', VerifyController::class);
        $route->add('post', PostController::class);
        $route->add('attachment', AttachmentController::class);
    }

    public function createWordpressForm()
    {
        add_action('admin_menu', [$this, 'buildAgcAdminMenu']);
    }

    public function generateWelcomeToken()
    {
        $repo = new TokenRepository();
        if (!$repo->check()) {
            $token = $repo->generate();
            $repo->set($token);
        }
    }

    public function checkPhpVersion()
    {
        if (version_compare(phpversion(), '5.6.0', '<')) {
            $this->error_message = 'AGCManager : Your php version is old. Please upgrade to 5.6 or later';
            add_action('admin_notices', [$this, 'showNotice']);
        }
    }

    public function showNotice()
    {
        echo '<div class="error"><p>' . $this->error_message . '</p></div>';
    }

    public function buildAgcAdminMenu()
    {
        add_menu_page('AGC Manager', 'AGC Manager', 'manage_options', 'agcmanager_index', [$this, 'agcmanager_index'], null, 1);
    }

    public function agcmanager_index()
    {
        echo "Your token is " . (new TokenRepository())->get();
    }
}