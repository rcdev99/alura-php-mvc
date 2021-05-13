<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Helper\RenderizadorDeHtmlTrait;
use Alura\Cursos\Infra\EntityManagerCreator;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ListarCursos implements RequestHandlerInterface
{
    use RenderizadorDeHtmlTrait;
    
    private $repositorioCursos;

    public function __construct()
    {
       $entityManager = (new EntityManagerCreator())
            ->getEntityManager();
        $this->repositorioCursos = $entityManager
            ->getRepository(Curso::class);
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $html = $this->renderizaHtml('cursos/listar-cursos.php', [
            'cursos' => $cursos = $this->repositorioCursos->findAll(),
            'titulo' => $titulo = 'Lista de Cursos',
        ]);

        return new Response(200, [], $html);
    }
}

