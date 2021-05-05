<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Helper\RenderizadorDeHtmlTrait;
use Alura\Cursos\Infra\EntityManagerCreator;

class ListarCursos implements iController
{
    use RenderizadorDeHtmlTrait;
    
    private $repositorioCursos;

    public function __construct()
    {
       $entityManager = (new EntityManagerCreator())
            ->getEntityManager();
        $this->repositorioCursos = $entityManager
            ->getRepository(Curso::class);
    }

    public function processaRequisicao() : void
    {
        echo $this->renderizaHtml('cursos/listar-cursos.php', [
            'cursos' => $cursos = $this->repositorioCursos->findAll(),
            'titulo' => $titulo = 'Lista de Cursos',
        ]);
    }
}

