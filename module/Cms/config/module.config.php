<?php

namespace Cms;

use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'controllers'  => [
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class,

        ]
    ],
    'router'       => [
        'routes' => [
            'autenticacao' => [
                'type'    => 'literal',
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\AuthController::class,
                        'action'     => 'autenticacao'
                    ]
                ]
            ],
            'sair'         => [
                'type'    => 'literal',
                'options' => [
                    'route'    => '/sair',
                    'defaults' => [
                        'controller' => Controller\AuthController::class,
                        'action'     => 'sair'
                    ]
                ]
            ],
            'usuario'      => [
                'type'    => 'segment',
                'options' => [
                    'route'       => '/usuario[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults'    => [
                        'controller' => Controller\UsuarioController::class,
                        'action'     => 'listagem'
                    ]
                ]
            ]
        ]
    ],
    'view_manager' => [
        'display_not_found_reason' => TRUE,
        'display_exceptions'       => TRUE,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map'             => [
            'layout/layout'       => __DIR__ . '/../view/layout/cms.phtml',
            'error/404'           => __DIR__ . '/../view/error/404.phtml',
            'error/index'         => __DIR__ . '/../view/error/index.phtml'
        ],
        'template_path_stack'      => [
            'cms' => __DIR__ . "/../view"
        ],
        'excluir'                  => FALSE
    ]
];