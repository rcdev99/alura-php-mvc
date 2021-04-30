<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Infra\EntityManagerCreator;

class ListarCursos implements iController
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
        $cursos = $this->repositorioCursos->findAll();
        require __DIR__ . '/../../view/cursos/listar-cursos.php';
    }
}

