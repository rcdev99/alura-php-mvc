<?php

require __DIR__ . '/../vendor/autoload.php';

use Alura\Cursos\Controller\FormInsereCurso;
use Alura\Cursos\Controller\ListarCursos;

$erro = "Erro 404 - Not Found";

if (isset($_SERVER['PATH_INFO'])) {

    $path_url = strtolower($_SERVER['PATH_INFO']);

    switch ($path_url) {
        case '/listar-cursos':
            $controlador = new ListarCursos();
            $controlador->processaRequisicao();
            break;
        case '/novo-curso':
            $controlador = new FormInsereCurso();
            $controlador->processaRequisicao();    
            break;
        default:
            echo $erro;
            break;
    }
}else{
    echo $erro;
}
