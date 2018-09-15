<?php
/**
 * Created by PhpStorm.
 * User: azesm
 * Date: 07.09.2018
 * Time: 13:53
 */

use Doctrine\DBAL\Driver\PDOPgSql\Driver as PDOPgSqlDriver;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

return [
  'doctrine' => [
    'connection' => [
      'orm_default' => [
        'driverClass' => PDOPgSqlDriver::class,
        'params' => [
          'host' => 'localhost',
          'port' => '5433',
          'dbname' => 'mobile',
        ],
      ],
    ],
    'driver' => [
      'Doctrine_driver' => [
        'class' => AnnotationDriver::class,
        'cache' => 'array',
        'paths' => [
          __DIR__ . '/../../module/Application/src/Entity',
        ]
      ],
      'orm_default' => [
        'drivers' => [
          'Application\\Entity' => 'Doctrine_driver',
        ]
      ]
    ],
    'migrations_configuration' => [
      'orm_default' => [
        'directory' => 'data/migrations',
        'name' => 'Migrations Name',
        'namespace' => 'Application',
        'table' => 'migrations_table',
        'column' => 'version',
        'custom_template' => null,
      ],
    ],
  ]
];