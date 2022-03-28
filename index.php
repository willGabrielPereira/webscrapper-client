<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/app/settings.php';

$app = new \Slim\App(['settings' => $settings]);

$container = $app->getContainer();
require __DIR__ . '/app/dependencies.php';

require __DIR__ . '/app/routes.php';

$app->run();
