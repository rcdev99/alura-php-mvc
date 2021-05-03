<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Infra\EntityManagerCreator;
use Doctrine\ORM\EntityManagerInterface;

class FormAlteraCurso implements iController
{
     
    private $repositorioCurso;

    public function __construct()
    {
        $entityManager = (new EntityManagerCreator())->getEntityManager();
        $this->repositorioCurso = $entityManager->getRepository(Curso::class);
    }

    public function processaRequisicao(): void
    {
        $id = filter_input(
            INPUT_GET,
            'id',
            FILTER_VALIDATE_INT
        );

        if(is_null($id) || $id === false){
            header('Location: /listar-cursos', true, 302);
            return;
        }

        $curso = $this->repositorioCurso->find($id);
        $titulo = 'Alterar Curso';
        require __DIR__ . '/../../view/cursos/formulario-insere-cursos.php';

    }

}

