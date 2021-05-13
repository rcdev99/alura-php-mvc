<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Usuario;
use Alura\Cursos\Helper\FlashMessageTrait;
use Alura\Cursos\Infra\EntityManagerCreator;
use Doctrine\Persistence\ObjectRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RealizarLogin implements RequestHandlerInterface
{
    use FlashMessageTrait;
    /**
     * @var ObjectRepository
     */
    private $usuariosRepository;

    public function __construct()
    {
        $entityManager = (new EntityManagerCreator())->getEntityManager();
        $this->usuariosRepository = $entityManager->getRepository(Usuario::class);
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        //Obtendo dados da requisição
        $email = filter_var($request->getParsedBody()['email'],
            FILTER_VALIDATE_EMAIL
        );

        $senha = filter_var($request->getParsedBody()['senha'],
            FILTER_SANITIZE_STRING
        );

        if (is_null($email) || $email === false) {
            $this->defineMensagem('danger','E-mail inválido');
            return new Response(302, ['Location' => '/login']);
        }

        /**
         * @var Usuario $usuario
         */
        $usuario = $this->usuariosRepository->findOneBy(['email' => $email]);

        if (is_null($usuario) || !$usuario->senhaEstaCorreta($senha)) {
            $this->defineMensagem('danger','E-mail ou senha inválidos');
            return new Response(302, ['Location' => '/login']);
        }

        $_SESSION['logado'] = true;
        
        return new Response(302, ['Location' => '/listar-cursos']);
    }

}

