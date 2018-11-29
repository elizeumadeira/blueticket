<?php

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

require 'vendor/autoload.php';
require 'config.php';

function d()
{
    $args = func_get_args();
    echo '<pre>';
    foreach ($args as $arg) {
        var_dump($arg);
    }
    echo '</pre>';
}

function dd()
{
    d(func_get_args());
    die();
}

$settings = [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        // "db" => [
        //     "host" => 'localhost',
        //     "dbname" => 'blueticket',
        //     "user" => 'root',
        //     "pass" => 'mysql',
        // ],
    ],
];
$app = new \Slim\App($settings);

// Get container
$container = $app->getContainer();
$container['view'] = function ($container) {
    return new \Slim\Views\Twig('templates/');
};

// $container['HomeController'] = function ($container) {
//     return new HomeController($container->get('view'));
// };

// function get_tempo($tempo) {
//     if (!in_array($tempo, array(15, 30))) {
//         return 15;
//     }

//     return (int) $tempo;
// }

//insere o dominio atual em "$args"
// $mw = function ($request, $response, $next) {
//     $baseuri = 'http://' . $request->getUri()->getHost().':8080' . $request->getUri()->getBasePath();
//     $request = $request->withAttribute('baseuri', $baseuri);
//     $response = $next($request, $response);
//     return $response;
// };

$app->get('/', function (Request $request, Response $response, array $args) {
    return \App\Controller\HomeController::index($request, $response, $this->view);
});

$app->group('/eventos', function () use ($app) {

    $app->get('', function (Request $request, Response $response, array $args) {
        // return $this->view->render($response, $nome_template, $data);
        return \App\Controller\EventoController::index($request, $response, $this->view);
    });

    $app->get('/adicionar', function (Request $request, Response $response, array $args) {
        // return $this->view->render($response, $nome_template, $data);
        return \App\Controller\EventoController::adicionar($request, $response, $this->view);
    });

    $app->post('/adicionar', function (Request $request, Response $response, array $args) {
        // dd($request->getParsedBody());
        // return $this->view->render($response, $nome_template, $data);
        return \App\Controller\EventoController::inserir_evento( $request,  $response, $this->view);
    });

    $app->get('/tipoingresso', function (Request $request, Response $response, array $args) {
        // return $this->view->render($response, $nome_template, $data);
        return \App\Controller\EventoController::inserir_tipoingresso($request, $response, $this->view);
    });

    $app->get('/visualizar/{id}', function (Request $request, Response $response, array $args) {
        // return $this->view->render($response, $nome_template, $data);
        $id_evento = $args['id'];
        return \App\Controller\EventoController::visualizar($request, $response, $this->view, $id_evento);
    });
});

$app->group('/ingressos', function () use ($app) {

});

$app->run();
 