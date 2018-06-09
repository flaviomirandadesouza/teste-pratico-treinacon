<?php

namespace Cms\Service\Factory;

use Cms\Model\UsuarioTable;
use Interop\Container\ContainerInterface;
use Zend\Authentication\Adapter\DbTable\CallbackCheckAdapter;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session;
use Zend\Db\Adapter\AdapterInterface;

class AuthenticationServiceFactory
{
    public function __invoke(ContainerInterface $container)
    {

        $senhaCallback = function ($senhaDb, $senhaForm) use ($container) {
            $usuario = $container->get(UsuarioTable::class);
            $usuario = $usuario->findByPassword($senhaDb);
            $senhaForm = md5($usuario->salt . $senhaForm);

            return $senhaDb == $senhaForm;
        };
        $dbAdaoter = $container->get(AdapterInterface::class);
        $authAdapter = new CallbackCheckAdapter($dbAdaoter, 'usuario', 'email', 'senha', $senhaCallback);

        $storage = new Session();
        return new AuthenticationService($storage, $authAdapter);


    }
}