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
use Application\Model\EISMobile;

class ConsoleController extends AbstractActionController
{
  private $console;
  private $eisMobile;

  public function __construct(Console $console, EISMobile $eisMobile)
  {
    $this->console = $console;
    $this->eisMobile = $eisMobile;
  }

  private function getConsole()
  {
    return $this->console;
  }

  public function listenAction()
  {
    $this->getConsole()->writeLine("Starting listener...");
    $result = $this->eisMobile->run();
  }

}