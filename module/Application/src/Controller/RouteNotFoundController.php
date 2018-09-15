<?php
/**
 * Created by PhpStorm.
 * User: azesm
 * Date: 31.08.2018
 * Time: 13:35
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;

class RouteNotFoundController extends AbstractActionController
{
  /**
   * Not Found Route for api give an error to api
   *
   * @return JSON
   */
  public function routenotfoundAction()
  {
    $jsonModelArr = ['success' => false, 'message' => 'Route not found!'];

    $httpResponse = $this->getResponse();
    $httpResponse->setStatusCode(200);
    $httpResponse->getHeaders()->addHeaders(['Content-type' => 'application/json']);
    $view = new JsonModel($jsonModelArr);
    $httpResponse->setContent($view->serialize());

    return $httpResponse;
  }
}