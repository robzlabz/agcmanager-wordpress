<?php

namespace Agc;

use Agc\Controller\AttachmentController;
use Agc\Controller\DashboardController;
use Agc\Controller\PostController;
use Agc\Controller\RemoteController;
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
        $route->add('remote', RemoteController::class);
    }

    public function createInterface()
    {
        (new DashboardController())->handle();
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

}