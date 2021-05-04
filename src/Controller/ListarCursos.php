<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Infra\EntityManagerCreator;

class ListarCursos extends HtmlController implements iController
{
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

