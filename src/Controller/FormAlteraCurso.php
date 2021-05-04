<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Infra\EntityManagerCreator;

class FormAlteraCurso extends HtmlController implements iController
{
     
    private $repositorioCurso;

    public function __construct()
    {
        $entityManager = (new EntityManagerCreator())->getEntityManager();
        $this->repositorioCurso = $entityManager->getRepository(Curso::class);
    }

    public function processaRequisicao(): void
    {
        $id = filter_input(
            INPUT_GET,
            'id',
            FILTER_VALIDATE_INT
        );

        if(is_null($id) || $id === false){
            header('Location: /listar-cursos', true, 302);
            return;
        }

        echo $this->renderizaHtml('cursos/formulario-insere-cursos.php', [
            'curso' => $curso = $this->repositorioCurso->find($id),
            'titulo' => 'Alterar Curso'
        ]);

    }

}

