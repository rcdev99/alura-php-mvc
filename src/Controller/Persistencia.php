<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Infra\EntityManagerCreator;
use Doctrine\ORM\EntityManagerInterface;

class Persistencia implements iController
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
    
    public function processaRequisicao() : void
    {
        $descricao = $_POST['descricao'];
        $curso = new Curso;
        $curso->setDescricao($descricao);
        
        var_dump($curso);

        $this->entityManager->persist($curso);
        $this->entityManager->flush();

    }

}
