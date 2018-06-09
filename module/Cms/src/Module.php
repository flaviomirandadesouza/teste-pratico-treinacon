<?php

namespace Cms;

use Cms\Controller\AuthController;
use Cms\Controller\Factory\AuthControllerFactory;
use Cms\Controller\UsuarioController;
use Cms\Service\Factory\AuthenticationServiceFactory;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\AuthenticationServiceInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Mvc\MvcEvent;

class Module implements ConfigProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . "/../config/module.config.php";
    }

    public function onBootstrap(MvcEvent $e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        $container = $e->getApplication()->getServiceManager();

        $eventManager->attach(MvcEvent::EVENT_DISPATCH,
            function (MvcEvent $e) use ($container) {
                $match = $e->getRouteMatch();
                $authService = $container->get(AuthenticationServiceInterface::class);
                $routeName = $match->getMatchedRouteName();

                $publicRoutes = ['autenticacao'];

                if (in_array($routeName, $publicRoutes) || $authService->hasIdentity()) {
                    return;
                } else {
                    $match->setParam('controller', AuthController::class)
                        ->setParam('action', 'autenticacao');
                }
            }, 100);
    }

    public function getServiceConfig()
    {
        return [
            'aliases'   => array(
                AuthenticationService::class => AuthenticationServiceInterface::class
            ),
            'factories' => [
                AuthenticationServiceInterface::class => AuthenticationServiceFactory::class,
                Model\UsuarioTable::class             => function ($container) {
                    $tableGateway = $container->get(Model\UsuarioTableGateway::class);
                    return new Model\UsuarioTable($tableGateway);
                },
                Model\UsuarioTableGateway::class      => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSet = new ResultSet();
                    $resultSet->setArrayObjectPrototype(new Model\Usuario());
                    return new TableGateway('usuario', $dbAdapter, NULL, $resultSet);
                }
            ]
        ];
    }

    public function getControllerConfig()
    {
        return [
            'factories' => [
                UsuarioController::class => function ($container) {
                    return new UsuarioController($container->get(Model\UsuarioTable::class));
                },
                AuthController::class    => AuthControllerFactory::class
            ]
        ];
    }
}