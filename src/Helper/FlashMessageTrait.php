<?php

namespace Alura\Cursos\Helper;

trait FlashMessageTrait
{
    public function defineMensagem(string $tipo, string $mensagem)
    {
        $_SESSION['tipo_mensagem'] = $tipo;
        $_SESSION['mensagem'] = $mensagem;
    }
}
