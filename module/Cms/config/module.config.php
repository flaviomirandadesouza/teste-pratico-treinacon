<?php

namespace Cms;

use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'controllers'  => [
        'factories' => [
            Controller\AuthController::class => InvokableFactory::class,
            Controller\IndexController::class => InvokableFactory::class,
            Controller\UsuarioController::class => InvokableFactory::class
        ]
    ],
    'router'       => [
        'routes' => [
            'home' => [
                'type'    => 'literal',
                'options' => [
                    'route'    => '/cms',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index'
                    ]
                ]
            ]
        ]
    ],
    'view_manager' => [
        'template_path_stack' => [
            'cms' => __DIR__ . "/../view"
        ]
    ]
];