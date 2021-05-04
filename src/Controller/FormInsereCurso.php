<?php

namespace Alura\Cursos\Controller;

class FormInsereCurso extends HtmlController implements IController
{
    public function processaRequisicao() : void
    {
        echo $this->renderizaHtml('cursos/formulario-insere-cursos.php', [
            'titulo' => $titulo = 'Novo Curso',
        ]);
        
    }
}