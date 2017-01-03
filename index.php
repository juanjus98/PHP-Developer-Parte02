<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use Slim\Views\PhpRenderer;

require 'app/vendor/autoload.php';

// instantiate the App object
$app = new \Slim\App();

$container = $app->getContainer();
$container['renderer'] = new PhpRenderer("./templates");

// Add route callbacks
$app->get('/', function ($request, $response, $args) {
    return $response->withStatus(200)->write('Hello World!');
});

$app->get('/hello[/{name}]', function ($request, $response, $args) {
    $response->write("Hello, " . $args['name']);
    return $response;
})->setArgument('name', 'World!');



// Run application
$app->run();