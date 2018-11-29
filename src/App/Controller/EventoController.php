<?php

namespace App\Controller;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use \App\DataBase\DB;

class EventoController extends Controller
{
    public function index(Request $request, Response $response, $view)
    {
        $eventos = DB::select_all('evento');
        $eventos = DB::getInstance()->get_evento_lista();
        return $view->render($response, 'evento/listar.php', [
            'eventos' => $eventos,
        ]);
    }

    public function adicionar(Request $request, Response $response, $view)
    {
        $eventos = DB::select_all('evento');
        return $view->render($response, 'evento/adicionar.php', [
            'eventos' => $eventos,
        ]);
    }

    public function inserir_evento(Request $request, Response $response, $view)
    {
        $campos = $request->getParsedBody();
        //segunda validação
        if (
            //nome não pode ser vazio
            $campos['nome'] == '' ||
            //cidade não pode ser vazio
            $campos['cidade'] == '' ||
            //preço não pode ser vazio
            $campos['preco'] == '' ||
            //inicio não pode ser vazio
            $campos['inicio'] == '' ||
             //fim não pode ser vazio
             $campos['fim'] == ''
        
        ) {
            return $view->render($response, 'evento/adicionar.php', [
                'erro' => 'Houve um erro ao inserir evento. Favor, verifique os dados inseridos e tente novamente.',
            ]);
        }
        
        //insere o evento
        $id_evento = DB::insert('evento', [
        'nome' => $campos['nome'],
        'cidade' => $campos['cidade'],
        'uf'=> $campos['uf'],
        'precobase' => $campos['preco'],
        'dia_inicio' => $campos['inicio'],
        'dia_fim' => $campos['fim'],
       ]);

        //faz a inserção das opções do evento
        foreach ($campos["ingressodescricao"] as $ind => $tipo_ingresso) {
            DB::insert('opcao_evento', [
                'id_evento' => $id_evento,
                'descricao' => $campos["ingressodescricao"][$ind],
                'lote'=> $campos["ingressolote"][$ind],
                'valor' => $campos["ingressovalor"][$ind],
                'qtd_max' => $campos["ingressoqtd_max"][$ind],
                'dia_inicio' => $campos["ingressoinicio"][$ind],
                'dia_fim' => $campos["ingressofim"][$ind],
                'observacao' => $campos["ingressoobservacao"][$ind],
               ]);
        }

        // $response->redirect($app->urlFor('listar_evento'), 200);
        return $view->render($response, 'evento/tipoingresso.php');
    }

    public function inserir_tipoingresso(Request $request, Response $response, $view)
    {
        return $view->render($response, 'evento/tipoingresso.php');
    }

    public function visualizar(Request $request, Response $response, $view, $id_evento)
    {
        $evento = DB::select('evento', [
            'id' => $id_evento
        ]);

        if (sizeof($evento) == 0) {
            return $view->render($response, 'evento/eventonaoencontrado.php', [
        'eventos' => $eventos,
    ]);
        }

        $evento['dia_inicio'] = substr($evento['dia_inicio'], 0,10);
        $evento['dia_fim'] = substr($evento['dia_fim'], 0,10);

        // $tipo_ingressos = DB::select_all('opcao_evento', [
        //     'id_evento' => $id_evento
        // ]);

        $tipo_ingressos = DB::getInstance()->get_opcao_evento($id_evento);
        return $view->render($response, 'evento/adicionar.php', [
            'disabled' => true,
            'evento' => $evento,
            'ingressos' => $tipo_ingressos
        ]);
    }
}
