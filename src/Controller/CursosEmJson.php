<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Infra\EntityManagerCreator;
use Doctrine\Persistence\ObjectRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CursosEmJson implements RequestHandlerInterface
{
    /**
     * @var ObjectRepository
     */
    private $cursosRepository;

    public function __construct()
    {
        $entityManagerCreator = new EntityManagerCreator();
        $entityManager = $entityManagerCreator->getEntityManager();
        $this->cursosRepository = $entityManager->getRepository(Curso::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $cursos = $this->cursosRepository->findAll();
        return new Response(
            200, 
            ['Content-Type' => 'application/json'], 
            json_encode($cursos)
        );
    }
}