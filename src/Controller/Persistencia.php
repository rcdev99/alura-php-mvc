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
        //utilização de filtros para obtenção de dados do input
        $descricao = filter_input(
            INPUT_POST,
            'descricao',
            FILTER_SANITIZE_STRING);
        //instanciando
        $curso = new Curso;
        $curso->setDescricao($descricao);
        //persistindo
        $this->entityManager->persist($curso);
        $this->entityManager->flush();

        header('Location: /listar-cursos', true, 302);
    }

}
