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
use Zend\ServiceManager;

class EISMobile
{

  /**
   * @var AdapterInterface
   */
  private $_db;

  /**
   * @var ServiceManager
   */
  private $_sm;

  /**
   * @var PluginManager
   */
  private $_pm;

  /**
   * EISMobile constructor.
   * @param $controllerPluginManager
   * @param $serviceManager
   * @param AdapterInterface $dbAdapter
   */
  public function __construct($controllerPluginManager, $serviceManager, AdapterInterface $dbAdapter) {
    $this->_db = $dbAdapter;
    $this->_sm = $serviceManager;
    $this->_pm = $controllerPluginManager;
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
    $tableGateway = new TableGateway('oauth_access_tokens', $this->_db);

    $resultSet = $tableGateway->select(function (Select $select) {
      $select->order(array('expires asc'));
    });
    $resultSet = $resultSet->toArray();
    // <----

    // тест на получение класса и работа с ним
    $pullData = $this->_pm->get('pull');
    $res = $pullData->run();

    return ['success' => true, 'message' => 'You accessed my APIs! Поздравляю!'];
  }

}
