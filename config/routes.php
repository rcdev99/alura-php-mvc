<?php

use Alura\Cursos\Controller\Deslogar;
use Alura\Cursos\Controller\Exclusao;
use Alura\Cursos\Controller\FormAlteraCurso;
use Alura\Cursos\Controller\FormInsereCurso;
use Alura\Cursos\Controller\FormLogin;
use Alura\Cursos\Controller\ListarCursos;
use Alura\Cursos\Controller\Persistencia;
use Alura\Cursos\Controller\RealizarLogin;

return $rotas = [
    '/listar-cursos' => ListarCursos::class,
    '/novo-curso' => FormInsereCurso::class,
    '/salvar-curso' => Persistencia::class,
    '/excluir-curso' => Exclusao::class,
    '/alterar-curso' => FormAlteraCurso::class,
    '/login' => FormLogin::class,
    '/realiza-login' => RealizarLogin::class,
    '/logout' => Deslogar::class,
];