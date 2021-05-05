<?php

namespace Alura\Cursos\Helper;

trait RenderizadorDeHtmlTrait
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