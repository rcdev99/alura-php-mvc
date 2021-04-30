<?php

namespace Alura\Cursos\Controller;

class FormInsereCurso implements IController
{
    public function processaRequisicao() : void
    {
        require __DIR__ . '/../../view/cursos/formulario-insere-cursos.php';
    }
}