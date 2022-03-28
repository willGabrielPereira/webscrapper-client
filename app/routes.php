<?php
require __DIR__ . '/../vendor/autoload.php';

use model\Bidding;
use model\File;
use model\History;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/', function (Request $request, Response $response, array $args) {
    $response->getBody()->write("Hello World");

    return $response;
});

###############
## HISTORIES ##
###############

$app->get('/histories', function (Request $request, Response $response, array $args) use ($app) {
    $historyies = (new History($app))->db()->get();

    return $response->withStatus(200)->withHeader('Content-Type', 'application/json')->write(json_encode($historyies));
});

$app->get('/histories/{id}', function (Request $request, Response $response, array $args) use ($app) {
    $historyies = (new History($app))->db()->find($args['id']);

    return $response->withStatus(200)->withHeader('Content-Type', 'application/json')->write(json_encode($historyies));
});

$app->post('/histories', function (Request $request, Response $response, array $args) use ($app) {
    $history = new History($app, (array)$request->getParsedBody());

    if (($id = $history->db()->where('status', $history->status)->where('date', $history->date)->first()) && ($id = $id->id))
        $history->id = $id;

    $history->save();
    return $response->withStatus(200)->withHeader('Content-Type', 'application/json')->write(json_encode($history->getAttributes()));
});



###########
## FILES ##
###########

$app->get('/files', function (Request $request, Response $response, array $args) use ($app) {
    $files = (new File($app))->db()->get();

    return $response->withStatus(200)->withHeader('Content-Type', 'application/json')->write(json_encode($files));
});

$app->get('/files/{id}', function (Request $request, Response $response, array $args) use ($app) {
    $file = (new File($app))->db()->find($args['id']);

    return $response->withStatus(200)->withHeader('Content-Type', 'application/json')->write(json_encode($file));
});

$app->post('/files', function (Request $request, Response $response, array $args) use ($app) {
    $file = new File($app, (array)$request->getParsedBody());

    if (($id = $file->db()->where('name', $file->name)->where('date', $file->date)->first()) && ($id = $id->id))
        $file->id = $id;

    $file->save();
    return $response->withStatus(200)->withHeader('Content-Type', 'application/json')->write(json_encode($file->getAttributes()));
});



##############
## BIDDINGS ##
##############

$app->get('/biddings', function (Request $request, Response $response, array $args) use ($app) {
    $biddings = (new Bidding($app))->db()->get();

    return $response->withStatus(200)->withHeader('Content-Type', 'application/json')->write(json_encode($biddings));
});

$app->get('/biddings/{id}', function (Request $request, Response $response, array $args) use ($app) {
    $bidding = (new Bidding($app))->db()->find($args['id']);

    return $response->withStatus(200)->withHeader('Content-Type', 'application/json')->write(json_encode($bidding));
});

$app->post('/biddings', function (Request $request, Response $response, array $args) use ($app) {
    $bidding = new Bidding($app, (array)$request->getParsedBody());

    if (($id = $bidding->db()->where('title', $bidding->title)->where('date', $bidding->date)->first()) && ($id = $id->id))
        $bidding->id = $id;

    $bidding->save();
    return $response->withStatus(200)->withHeader('Content-Type', 'application/json')->write(json_encode($bidding->getAttributes()));
});
