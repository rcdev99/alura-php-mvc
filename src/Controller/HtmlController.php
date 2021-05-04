<?php

namespace Alura\Cursos\Controller;

abstract class HtmlController 
{
    public function renderizaHtml(string $caminhoTemplate, array $dados):string
    {
        extract($dados);
        //inicializa buffer
        ob_start();
        require __DIR__ . '/../../view/' . $caminhoTemplate;
        //atriui o template e limpa o buffer
        $html = ob_get_clean();

        return $html;
    }
}