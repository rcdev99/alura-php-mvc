<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Helper\FlashMessageTrait;
use Alura\Cursos\Infra\EntityManagerCreator;
use Doctrine\ORM\EntityManagerInterface;

class Persistencia implements iController
{

    use FlashMessageTrait;
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
        
        //Capturando id da requisição
        $id = filter_input(
            INPUT_GET,
            'id',
            FILTER_VALIDATE_INT
        );
        
        //Atualização ou inserção ?
        if(!is_null($id) && $id !== false ){//UPDATE
            $curso->setId($id);
            $this->entityManager->merge($curso);
            $this->defineMensagem('success','Curso atualizado com sucesso');
        } else {//INSERT
            $this->entityManager->persist($curso);
            $this->defineMensagem('success','Curso criado com sucesso');
        }
        $_SESSION['tipo_mensagem'] = 'success';
        
        //Persistindo
        $this->entityManager->flush();

        header('Location: /listar-cursos', true, 302);
    }

}
