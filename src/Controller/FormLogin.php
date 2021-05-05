<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Helper\RenderizadorDeHtmlTrait;

class FormLogin implements iController
{
    use RenderizadorDeHtmlTrait;
    
    public function processaRequisicao(): void
    {
        echo $this->renderizaHtml('login/formLogin.php', [
            'titulo' => 'Login',
        ]);
    }
}