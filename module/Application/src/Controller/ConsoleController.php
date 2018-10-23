<?php
/**
 * Created by PhpStorm.
 * User: azesm
 * Date: 23.09.2018
 * Time: 16:33
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Console\Adapter\AdapterInterface as Console;
use Zend\Console\Request as ConsoleRequest;
use RuntimeException;
use Application\Model\PullData;

class ConsoleController extends AbstractActionController
{

  /**
   * Консоль
   * @var Console
   */
  private $_console;

  /**
   * Обработка данных с еис
   * @var PullData
   */
  private $_eisPullData;

  /**
   * ConsoleController constructor.
   * @param Console $console
   * @param PullData $eisPullData
   */
  public function __construct(Console $console, PullData $eisPullData)
  {
    $this->_console = $console;
    $this->_eisPullData = $eisPullData;
  }

  /**
   * @return Console
   */
  private function getConsole()
  {
    return $this->_console;
  }

  /**
   * Обновление справочников из консоли
   * @return mixed
   */
  public function updateDirectoryAction()
  {
    $request = $this->getRequest();

    if (!$request instanceof ConsoleRequest) {
      throw new RuntimeException('You can only use this action from a console!');
    }

    $typeDirectory = strtolower($request->getParam('typeDirectory', 'all'));
    $this->getConsole()->writeLine("Starting update...");

    $result = $this->_eisPullData->run($typeDirectory, $this->getConsole());

    return $result[0];
  }

}
