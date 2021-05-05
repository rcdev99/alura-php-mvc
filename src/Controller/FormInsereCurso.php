<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Helper\RenderizadorDeHtmlTrait;

class FormInsereCurso  implements IController
{
    use RenderizadorDeHtmlTrait;
    
    public function processaRequisicao() : void
    {
        echo $this->renderizaHtml('cursos/formulario-insere-cursos.php', [
            'titulo' => $titulo = 'Novo Curso',
        ]);
        
    }
}