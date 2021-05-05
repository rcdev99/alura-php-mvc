<?php

namespace Alura\Cursos\Controller;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Deslogar implements iController
{
    public function processaRequisicao(ServerRequestInterface $request) : ResponseInterface
    {
        session_destroy();
        return new Response(302, ['Location' => '/login']);
    }
}