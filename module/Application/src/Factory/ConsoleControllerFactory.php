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

class ConsoleControllerFactory implements FactoryInterface {

  public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
  {
    return new ConsoleController($container->get('console'));
  }

}