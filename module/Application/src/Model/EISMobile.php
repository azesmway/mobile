<?php
/**
 * Created by PhpStorm.
 * User: azesm
 * Date: 31.08.2018
 * Time: 17:56
 */

namespace Application\Model;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;

class EISMobile
{

  private $dbAdapter;
  private $serviceManager;
  private $pluginManager;

  /**
   * EISMobile constructor.
   * @param $controllerPluginManager
   * @param $serviceManager
   * @param AdapterInterface $dbAdapter
   */
  public function __construct($controllerPluginManager, $serviceManager, AdapterInterface $dbAdapter) {
    $this->dbAdapter = $dbAdapter;
    $this->serviceManager = $serviceManager;
    $this->pluginManager = $controllerPluginManager;
  }

  /**
   * Запускаем основное приложение
   *
   * @param $requestGet
   * @param $requestPost
   * @param $requestContent
   * @return array
   */
  public function run($requestGet = null, $requestPost = null, $requestContent = null) {

    // ---> Пока для теста, работа с таблицей
    $tableGateway = new TableGateway('oauth_access_tokens', $this->dbAdapter);

    $resultSet = $tableGateway->select(function (Select $select) {
      $select->order(array('expires asc'));
    });
    $resultSet = $resultSet->toArray();
    // <----

    // тест на получение класса и работа с ним
    $pullData = $this->pluginManager->get('pullData');
    $res = $pullData->run();

    return ['success' => true, 'message' => 'You accessed my APIs! Поздравляю!'];
  }

}