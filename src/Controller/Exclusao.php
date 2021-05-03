<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Infra\EntityManagerCreator;
use Doctrine\ORM\EntityManagerInterface;

class Exclusao implements iController
{

    /**
     * @var EntityManagerInterface
     */
    public $entityManager;

    public function __construct()
    {
        $entityManagerCreator = new EntityManagerCreator();
        $this->entityManager = $entityManagerCreator->getEntityManager();
    }

    public function processaRequisicao(): void
    {
        //Obtendo o ID da requisição
        $id = filter_input(
                INPUT_GET, 
                'id',
                FILTER_VALIDATE_INT
            );
        
        //Redirecionando caso o id seja nulo ou falso
        if (is_null($id) || $id === false) {
            header('Location: /listar-cursos', true, 302);
            return;
        }
        
        $curso = $this->entityManager->getReference(Curso::class, $id);

        $this->entityManager->remove($curso);
        $this->entityManager->flush();
        
        header('Location: /listar-cursos', true, 302);
    }

}