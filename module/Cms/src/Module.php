<?php

namespace Cms;

use Cms\Controller\UsuarioController;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . "/../config/module.config.php";
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                Model\UsuarioTable::class        => function ($container) {
                    $tableGateway = $container->get(Model\UsuarioTableGateway::class);
                    return new Model\UsuarioTable($tableGateway);
                },
                Model\UsuarioTableGateway::class => function ($container) {
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
                }
            ]
        ];
    }
}