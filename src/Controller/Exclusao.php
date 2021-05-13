<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Nyholm\Psr7\Response;
use Alura\Cursos\Helper\FlashMessageTrait;
use Alura\Cursos\Infra\EntityManagerCreator;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Exclusao implements RequestHandlerInterface
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
        $response = new Response(302, ['Location' => '/listar-cursos']);

        //Obtendo o ID da requisição
        $id = filter_var(
                $request->getQueryParams()['id'],
                FILTER_VALIDATE_INT
        );
        
        //Redirecionando caso o id seja nulo ou falso
        if (is_null($id) || $id === false) {
            $this->defineMensagem('danger','Curso não encontrado');
            return $response;
        }
        
        $curso = $this->entityManager->getReference(Curso::class, $id);

        $this->entityManager->remove($curso);
        $this->entityManager->flush();
        $this->defineMensagem('success','Curso removido');
        
        return $response;
    }

}