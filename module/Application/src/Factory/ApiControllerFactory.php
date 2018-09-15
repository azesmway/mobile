<?php
/**
 * Created by PhpStorm.
 * User: azesm
 * Date: 31.08.2018
 * Time: 12:22
 */

namespace Application\Factory;

use Application\Controller\ApiController;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Application\Model\EISMobile;

class ApiControllerFactory implements FactoryInterface {

  /**
   * @param ContainerInterface $container
   * @param string $requestedName
   * @param array|null $options
   * @return ApiController|object
   */
  public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
  {
    $controllerPluginManager = $container;
    $serviceManager          = $controllerPluginManager->get('ServiceManager');

    $server     = $serviceManager->get('ZF\OAuth2\Service\OAuth2Server');
    $provider   = $serviceManager->get('ZF\OAuth2\Provider\UserId');

    $eisMobile  = $controllerPluginManager->get(EISMobile::class);

    return new ApiController($server, $provider, $eisMobile);
  }

}