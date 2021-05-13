<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Helper\FlashMessageTrait;
use Alura\Cursos\Infra\EntityManagerCreator;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Persistencia implements RequestHandlerInterface
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
    
    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        //Obtendo dados da requisição
        $descricao = filter_var(
            $request->getParsedBody()['descricao'], 
            FILTER_SANITIZE_STRING
        );

        $id = filter_var(
            $request->getQueryParams()['id'],
            FILTER_VALIDATE_INT
        );

        //instanciando Curso
        $curso = new Curso;
        $curso->setDescricao($descricao);
        
        //Atualização ou inserção ?
        if(!is_null($id) && $id !== false ){//UPDATE
            $curso->setId($id);
            $this->entityManager->merge($curso);
            $this->defineMensagem('success','Curso atualizado com sucesso');
        } else {//INSERT
            $this->entityManager->persist($curso);
            $this->defineMensagem('success','Curso criado com sucesso');
        }
        
        //Persistindo
        $this->entityManager->flush();

        return new Response(302, ['Location' => '/listar-cursos']);
    }

}
