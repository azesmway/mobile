<?php
/**
 * Created by PhpStorm.
 * User: azesm
 * Date: 31.08.2018
 * Time: 12:22
 */

namespace Application\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Db\Adapter\AdapterInterface;
use Application\Model\EISMobile;

class EISMobileFactory implements FactoryInterface {

  /**
   * @param ContainerInterface $container
   * @param string $requestedName
   * @param array|null $options
   * @return EISMobile|object
   */
  public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
  {
    $controllerPluginManager  = $container;
    $serviceManager           = $controllerPluginManager->get('ServiceManager');
    $dbAdapter                = $controllerPluginManager->get(AdapterInterface::class);

    return new EISMobile($controllerPluginManager, $serviceManager, $dbAdapter);
  }

}