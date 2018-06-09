<?php

namespace Cms;

use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'controllers'  => [
        'factories' => [
            Controller\AuthController::class  => InvokableFactory::class,
            Controller\IndexController::class => InvokableFactory::class,

        ]
    ],
    'router'       => [
        'routes' => [
            'autenticacao'    => [
                'type'    => 'literal',
                'options' => [
                    'route'    => '/autenticacao',
                    'defaults' => [
                        'controller' => Controller\AuthController::class,
                        'action'     => 'autenticacao'
                    ]
                ]
            ],
            'recuperar-senha' => [
                'type'    => 'literal',
                'options' => [
                    'route'    => '/recuperar-senha',
                    'defaults' => [
                        'controller' => Controller\AuthController::class,
                        'action'     => 'recuperarSenha'
                    ]
                ]
            ],
            'redefinir-senha' => [
                'type'    => 'segment',
                'options' => [
                    'route'    => '/redefinir-senha/:teste',
                    'defaults' => [
                        'controller' => Controller\AuthController::class,
                        'action'     => 'redefinirSenha'
                    ]
                ]
            ],
            'home-cms'        => [
                'type'    => 'literal',
                'options' => [
                    'route'    => '/cms',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index'
                    ]
                ]
            ],

            'usuario' => [
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
            'layout/layout' => __DIR__ . '/../view/layout/cms.phtml',
            'error/404'     => __DIR__ . '/../view/error/404.phtml',
            'error/index'   => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack'      => [
            'cms' => __DIR__ . "/../view"
        ]
    ]
];