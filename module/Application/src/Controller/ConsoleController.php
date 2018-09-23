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
use Application\Model\Eis\PullData;

class ConsoleController extends AbstractActionController
{
  private $console;
  private $eisPullData;

  public function __construct(Console $console, PullData $eisPullData)
  {
    $this->console = $console;
    $this->eisPullData = $eisPullData;
  }

  private function getConsole()
  {
    return $this->console;
  }

  public function updateDirectoryAction()
  {
    $request = $this->getRequest();
    $mode = $request->getParam('mode', 'all');

    $this->getConsole()->writeLine("Starting listener...");
    $result = $this->eisPullData->run($mode);
  }

}