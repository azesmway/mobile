<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\Log\Logger;

return [
  'router' => [
    'routes' => [
      'home' => [
        'type' => Literal::class,
        'options' => [
          'route' => '/',
          'defaults' => [
            'controller' => Controller\IndexController::class,
            'action' => 'index',
            'isAuthorizationRequired' => false
          ],
        ],
      ],
      'api' => [
        'type' => Segment::class,
        'options' => [
          'route' => '/api[/:action]',
          'defaults' => [
            'controller' => Controller\ApiController::class,
            'action' => 'api',
            'isAuthorizationRequired' => true
          ],
        ],
      ],
      '404' => [
        'type' => Segment::class,
        'options' => [
          'route' => '/:*',
          'defaults' => [
            'controller' => Controller\RouteNotFoundController::class,
            'action' => 'routenotfound',
          ],
        ],
        'priority' => -1000,
      ],
    ],
  ],
  'console' => [
    'router' => [
      'routes' => [
        'listen' => [
          'type'    => 'simple',
          'options' => [
            'route'    => 'listen',
            'defaults' => [
              'controller' => Controller\ConsoleController::class,
              'action'     => 'listen',
            ],
          ],
        ],
      ],
    ],
  ],
  'controllers' => [
    'factories' => [
      Controller\IndexController::class => Factory\IndexControllerFactory::class,
      Controller\ApiController::class => Factory\ApiControllerFactory::class,
      Controller\RouteNotFoundController::class => InvokableFactory::class,
      Controller\ConsoleController::class => Factory\ConsoleControllerFactory::class,
    ]
  ],
  'service_manager' => [
    'factories' => [
      Model\EISMobile::class => Factory\EISMobileFactory::class,
      Model\Eis\PullData::class => Factory\PullDataFactory::class,
    ],
    'aliases' => [
      'eis' => Model\EISMobile::class,
      'pullData' => Model\Eis\PullData::class,
    ],
    'abstract_factories' => [
      'Zend\Log\LoggerAbstractServiceFactory',
    ],
  ],
  'view_manager' => [
    'display_not_found_reason' => true,
    'display_exceptions' => true,
    'doctype' => 'HTML5',
    'not_found_template' => 'error/404',
    'exception_template' => 'error/index',
    'template_map' => [
      'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
      'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
      'error/404' => __DIR__ . '/../view/error/404.phtml',
      'error/index' => __DIR__ . '/../view/error/index.phtml',
    ],
    'template_path_stack' => [
      __DIR__ . '/../view',
    ],
  ],
  'log' => [
    'logger' => [
      'writers' => [
        [
          'name' => 'stream',
          'options' => [
            'stream' => __DIR__ . '/../../../logs/errors.log',
          ],
        ],
      ],
    ],
  ],
];
