<?php

namespace Cms\Controller\Factory;

use Cms\Controller\AuthController;
use Interop\Container\ContainerInterface;
use Zend\Authentication\AuthenticationServiceInterface;

class AuthControllerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $authService = $container->get(AuthenticationServiceInterface::class);
        return new AuthController($authService);
    }
}