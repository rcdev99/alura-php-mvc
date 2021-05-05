<?php

require __DIR__ . '/../vendor/autoload.php';

use Alura\Cursos\Controller\iController;

$rotas = require __DIR__ . '/../config/routes.php';
$caminho_url = strtolower($_SERVER['PATH_INFO']); 

if (!array_key_exists($caminho_url, $rotas)) {
    http_response_code(404);
    exit();
}

//iniciando sessão
session_start();

$rotaDeLogin = stripos($caminho_url, 'login');

if (!isset($_SESSION['logado']) && $rotaDeLogin === false ){
    header('Location: /login', true, 302);
    exit();
}

//Obtendo class a ser instanciada através da rota mapeada
$classControladora = $rotas[$caminho_url];
/**
 * @var iController $controlador
 */
//Instanciando classe de acordo com mapeamento
$controlador = new $classControladora;
$controlador->processaRequisicao();
