<?php
$container = $app->getContainer();

$container['db'] = function ($container) {
    $capsule = new \Illuminate\Database\Capsule\Manager;
    $capsule->addConnection($container['settings']['db']);

    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    return $capsule;
};


// $container[App\WidgetController::class] = function ($c) {
//     $view = $c->get('view');
//     $logger = $c->get('logger');
//     $table = $c->get('db')->table('table_name');
//     return new \App\WidgetController($view, $logger, $table);
// };
