<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Usuario;
use Alura\Cursos\Infra\EntityManagerCreator;
use Doctrine\Persistence\ObjectRepository;

class RealizarLogin implements iController
{
    /**
     * @var ObjectRepository
     */
    private $usuariosRepository;

    public function __construct()
    {
        $entityManager = (new EntityManagerCreator())->getEntityManager();
        $this->usuariosRepository = $entityManager->getRepository(Usuario::class);
    }

    public function processaRequisicao(): void
    {
        $email = filter_input(
            INPUT_POST,
            'email',
            FILTER_VALIDATE_EMAIL
        );

        $senha = filter_input(
            INPUT_POST,
            'senha',
            FILTER_SANITIZE_STRING
        );

        if (is_null($email) || $email === false) {
            echo "E-mail inválido";
            return;
        }

        /**
         * @var Usuario $usuario
         */
        $usuario = $this->usuariosRepository->findOneBy(['email' => $email]);

        if (is_null($usuario) || !$usuario->senhaEstaCorreta($senha)) {
            echo "E-mail ou senha inválidos";
            return;
        }

        header('Location: /listar-cursos', true, 302);
    }

}

