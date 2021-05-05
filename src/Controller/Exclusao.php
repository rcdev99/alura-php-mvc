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
            $_SESSION['tipo_mensagem'] = 'danger';
            $_SESSION['mensagem'] = 'Curso não encontrado';
            header('Location: /listar-cursos', true, 302);
            return;
        }
        
        $curso = $this->entityManager->getReference(Curso::class, $id);

        $this->entityManager->remove($curso);
        $this->entityManager->flush();
        
        $_SESSION['tipo_mensagem'] = 'success';
        $_SESSION['mensagem'] = 'Curso removido';

        header('Location: /listar-cursos', true, 302);
    }

}