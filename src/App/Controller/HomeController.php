<?php

namespace App\Controller;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use \App\DataBase\DB;

class HomeController extends Controller
{
    public function index(Request $request, Response $response, $view)
    {
        // dd(DB::select_all('usuario'));
        return $view->render($response, 'commom/home.php', [
            'teste' => 'teste texto',
        ]);
    }

    
}
