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

class ConsoleController extends AbstractActionController
{
  private $console;

  public function __construct(Console $console)
  {
    $this->console = $console;
  }

  private function getConsole()
  {
    return $this->console;
  }

  public function listenAction()
  {
    $this->getConsole()->writeLine("Starting listener...");
  }

}