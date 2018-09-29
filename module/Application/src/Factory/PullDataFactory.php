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
use Application\Model\PullData;
use Zend\Db\Adapter\AdapterInterface;

class PullDataFactory implements FactoryInterface {

  /**
   * @param ContainerInterface $container
   * @param string $requestedName
   * @param array|null $options
   * @return PullData|object
   * @throws \FtpClient\FtpException
   */
  public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {

    $controllerPluginManager  = $container;
    $serviceManager           = $controllerPluginManager->get('ServiceManager');
    $dbAdapter                = $controllerPluginManager->get(AdapterInterface::class);
    $logger                   = $controllerPluginManager->get('logger');
    $eventManager             = $controllerPluginManager->get('EventManager');

    $entityManager = $container->get('doctrine.entitymanager.orm_default');

    $ftp = new \FtpClient\FtpClient;

    $host = 'ftp.zakupki.gov.ru';
    $login = 'fz223free';
    $password = 'fz223free';

    $ftp->connect($host);
    $ftp->login($login, $password);

    $pullData = new PullData($serviceManager, $dbAdapter, $ftp, $entityManager);
    $pullData->setLogger($logger);

    return $pullData;
  }

}