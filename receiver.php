<?php

/**
 * Plugin Name: Agcmanager Receiver
 * Plugin URI: https://agcmanager.com
 * Description: Connect Wordpress and Agcmanager
 * Author: Robbyn R
 * Version: 1.0.1
 * Author URI: https://github.com/robzlabz
 */

include __DIR__ . '/vendor/autoload.php';

use Agc\Application;

try {
    $app = new Application();
    $app->checkPhpVersion();
    $app->registerRoutes();
    $app->createInterface();
    $app->generateWelcomeToken();
} catch (Exception $e) {
    fatal('Fatal Error', [
        'message' => $e->getMessage(),
        'file' => $e->getFile(),
        'line' => $e->getLine()
    ]);
}

//$app->terminate();

