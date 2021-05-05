<?php

namespace Alura\Cursos\Controller;

class Deslogar implements iController
{
    public function processaRequisicao(): void
    {
        session_destroy();
        header('Location: /login', true, 302);
    }
}