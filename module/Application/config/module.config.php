<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Application\Controller\AdminController;
use Application\Controller\CssGeneratorController;
use Application\Controller\CssGeneratorControlller;
use Application\Controller\Factory\CssGeneratorControllerFactory;
use Application\Controller\Factory\ForumControllerFactory;
use Application\Controller\Factory\AdminControllerFactory;
use Application\Controller\Factory\SubjectControllerFactory;
use Application\Controller\Factory\TopicControllerFactory;
use Application\Controller\ForumController;
use Application\Controller\IndexController;
use Application\Controller\SubjectController;
use Application\Controller\TopicController;
use Application\Service\CssManager;
use Application\Service\Factory\CssManagerFactory;
use Application\Service\Factory\ForumManagerFactory;
use Application\Service\Factory\NavManagerFactory;
use Application\Service\Factory\PostManagerFactory;
use Application\Service\Factory\SubjectManagerFactory;
use Application\Service\Factory\TopicManagerFactory;
use Application\Service\ForumManager;
use Application\Service\NavManager;
use Application\Service\PostManager;
use Application\Service\SubjectManager;
use Application\Service\TopicManager;
use Application\View\Helper\BreadCrumbsHelper;
use Application\View\Helper\Factory\BreadCrumbsHelperFactory;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'forums' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/:id_forum',
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'forum'=>[
                        'type'    => Segment::class,
                        'options' => [
                            'route'    => '/forum[/:action[/:id]]',
                            'defaults' => [
                                'controller' => ForumController::class,
                                'action'     => 'list',
                            ],
                        ],
                    ],
                    'topic'=>[
                        'type'    => Segment::class,
                        'options' => [
                            'route'    => '/topic[/:action[/:id]]',
                            'defaults' => [
                                'controller' => TopicController::class,
                                'action'     => 'list',
                            ],
                        ],
                    ],
                    'subject'=>[
                        'type'    => Segment::class,
                        'options' => [
                            'route'    => '/subject[/:action[/:id]]',
                            'defaults' => [
                                'controller' => SubjectController::class,
                                'action'     => 'list',
                            ],
                        ],
                    ],
                    'css_generator'=>[
                        'type'    => Segment::class,
                        'options' => [
                            'route'    => '/css_generator[/:action[/:id]]',
                            'defaults' => [
                                'controller' => CssGeneratorController::class,
                                'action'     => 'show',
                            ],
                        ],
                    ],

                ],
            ],
            'admin'=>[
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/administration[/:action[/:id]]',
                    'defaults' => [
                        'controller' => AdminController::class,
                        'action'     => 'list',
                    ],
                ],
            ],

        ],
    ],
    'controllers' => [
        'factories' => [
            IndexController::class=>InvokableFactory::class,
            AdminController::class => AdminControllerFactory::class,
            ForumController::class=>ForumControllerFactory::class,
            TopicController::class=>TopicControllerFactory::class,
            SubjectController::class=>SubjectControllerFactory::class,
            CssGeneratorController::class=>CssGeneratorControllerFactory::class,
        ],
    ],
    'service_manager'=>[
        'factories'=>[
            PostManager::class=>PostManagerFactory::class,
            TopicManager::class=>TopicManagerFactory::class,
            SubjectManager::class=>SubjectManagerFactory::class,
            ForumManager::class=>ForumManagerFactory::class,
            CssManager::class=>CssManagerFactory::class,
            NavManager::class=>NavManagerFactory::class,
        ],
    ],
    'access_filter' => [
        'controllers' => [
            ForumController::class => [
                ['actions' => ['list'], 'allow' => '*'],
            ],
        ]

    ],
    'view_helpers' => [
        'factories' => [
            View\Helper\MenuHelper::class => View\Helper\Factory\MenuHelperFactory::class,
            BreadCrumbsHelper::class => BreadCrumbsHelperFactory::class,
        ],
        'aliases' => [
            'mainMenu' => View\Helper\MenuHelper::class,
            'breadCrumbs' => BreadCrumbsHelper::class,
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
        'strategies' => [
            'ViewJsonStrategy',
        ],
    ],
    'doctrine' => [
        'driver' => [
            __NAMESPACE__ . '_driver' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/Entity']
            ],
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ]
            ]
        ]
    ]
];
