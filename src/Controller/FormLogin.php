<?php

namespace Alura\Cursos\Controller;

class FormLogin extends HtmlController implements iController
{
    public function processaRequisicao(): void
    {
        echo $this->renderizaHtml('login/formLogin.php', [
            'titulo' => 'Login',
        ]);
    }
}