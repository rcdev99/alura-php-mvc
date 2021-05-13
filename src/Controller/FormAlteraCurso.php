<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Helper\FlashMessageTrait;
use Alura\Cursos\Helper\RenderizadorDeHtmlTrait;
use Alura\Cursos\Infra\EntityManagerCreator;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class FormAlteraCurso implements RequestHandlerInterface
{
    use RenderizadorDeHtmlTrait, 
        FlashMessageTrait;

    private $repositorioCurso;

    public function __construct()
    {
        $entityManager = (new EntityManagerCreator())->getEntityManager();
        $this->repositorioCurso = $entityManager->getRepository(Curso::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $id = filter_var(
            $request->getQueryParams()['id'],
            FILTER_VALIDATE_INT
        );

        if(is_null($id) || $id === false){
            
            $this->defineMensagem('danger', 'Curso inexistente');
            return new Response(302, ['Location' => '/listar-cursos']);
        }

        $html = $this->renderizaHtml('cursos/formulario-insere-cursos.php', [
            'curso' => $curso = $this->repositorioCurso->find($id),
            'titulo' => 'Alterar Curso'
        ]);
        
        return new Response(200, [], $html);
    }
}

