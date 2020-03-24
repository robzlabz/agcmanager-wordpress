<?php

/**
 * Plugin Name: Agcmanager Receiver
 */

include __DIR__ . '/vendor/autoload.php';

use Agc\Application;

$app = new Application();
$app->checkPhpVersion();
$app->registerRoutes();
$app->createWordpressForm();
$app->generateWelcomeToken();
//$app->terminate();

