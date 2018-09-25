<?php
/**
 * Created by PhpStorm.
 * User: azesm
 * Date: 31.08.2018
 * Time: 18:49
 */

namespace Application\Factory;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Application\Model\EntityBase;

class EntityBaseFactory implements FactoryInterface {

  /**
   * @param ContainerInterface $container
   * @param string $requestedName
   * @param array|null $options
   * @return EntityBase|object
   */
  public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {

    $controllerPluginManager  = $container;
    $serviceManager           = $controllerPluginManager->get('ServiceManager');
    $entityManager            = $controllerPluginManager->get('doctrine.entitymanager.orm_default');

    return new EntityBase($serviceManager, $entityManager);
  }

}