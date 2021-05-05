<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Helper\RenderizadorDeHtmlTrait;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class FormInsereCurso  implements IController
{
    use RenderizadorDeHtmlTrait;
    
    public function processaRequisicao(ServerRequestInterface $request) : ResponseInterface
    {
        $html = $this->renderizaHtml('cursos/formulario-insere-cursos.php', [
            'titulo' => $titulo = 'Novo Curso',
        ]);
        
        return new Response(200, [], $html);
    }
}