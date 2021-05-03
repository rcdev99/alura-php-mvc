<?php

use Alura\Cursos\Controller\Exclusao;
use Alura\Cursos\Controller\FormInsereCurso;
use Alura\Cursos\Controller\ListarCursos;
use Alura\Cursos\Controller\Persistencia;

return $rotas = [
    '/listar-cursos' => ListarCursos::class,
    '/novo-curso' => FormInsereCurso::class,
    '/salvar-curso' => Persistencia::class,
    '/excluir-curso' => Exclusao::class,
];