<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Helper\RenderizadorDeHtmlTrait;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class FormLogin implements iController
{
    use RenderizadorDeHtmlTrait;
    
    public function processaRequisicao(ServerRequestInterface $request) : ResponseInterface
    {
        $html = $this->renderizaHtml('login/formLogin.php', [
            'titulo' => 'Login',
        ]);

        return new Response(200, [], $html);
    }
}