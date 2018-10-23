<?php
/**
 * Created by PhpStorm.
 * User: azesm
 * Date: 31.08.2018
 * Time: 12:22
 */

namespace Application\Factory;

use Application\Controller\IndexController;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class IndexControllerFactory implements FactoryInterface {

  /**
   * @param ContainerInterface $container
   * @param $requestedName
   * @param array|null $options
   * @return IndexController|object
   */
  public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
  {
    $controllerPluginManager = $container;
    $serviceManager          = $controllerPluginManager->get('ServiceManager');

    $server   = $serviceManager->get('ZF\OAuth2\Service\OAuth2Server');
    $provider = $serviceManager->get('ZF\OAuth2\Provider\UserId');

    return new IndexController($server, $provider);
  }

}
