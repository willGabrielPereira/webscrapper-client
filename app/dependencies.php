<?php

use Illuminate\Database\Capsule\Manager;

$container['db'] = function ($container) {
    $capsule = new Manager;
    $capsule->addConnection($container['settings']['db']);

    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    return $capsule;
};

$container['view'] = new \Slim\Views\PhpRenderer('../templates/');