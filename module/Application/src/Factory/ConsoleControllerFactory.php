<?php
/**
 * Created by PhpStorm.
 * User: azesm
 * Date: 31.08.2018
 * Time: 12:22
 */

namespace Application\Factory;

use Application\Controller\ConsoleController;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Application\Model\PullData;

class ConsoleControllerFactory implements FactoryInterface {

  /**
   * @param ContainerInterface $container
   * @param $requestedName
   * @param array|null $options
   * @return ConsoleController|object
   */
  public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
  {
    return new ConsoleController($container->get('console'), $container->get(PullData::class));
  }

}
