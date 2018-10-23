<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use ZF\OAuth2\Controller\AuthController;
use OAuth2\Request as OAuth2Request;
use ZF\OAuth2\Provider\UserId\UserIdProviderInterface;
use Zend\View\Model\JsonModel;
use Application\Model\EISMobile;

class ApiController extends AuthController
{

  /**
   * Основное приложение
   * @var EISMobile
   */
  private $_eisMobile;

  /**
   * ApiController constructor.
   * @param $serverFactory
   * @param UserIdProviderInterface $userIdProvider
   * @param EISMobile $eisMobile
   */
  public function __construct($serverFactory, UserIdProviderInterface $userIdProvider, EISMobile $eisMobile) {
    parent::__construct($serverFactory, $userIdProvider);
    $this->_eisMobile = $eisMobile;
  }

  /**
   * Роутер /api - все обращения сюда
   *
   * @return bool|\Zend\Stdlib\ResponseInterface|\ZF\ApiProblem\ApiProblemResponse
   */
  public function apiAction() {

    if (($error = $this->checkAuthorization()) !== false) {
      return $error;
    }

    $requestGet = $this->getRequest()->getQuery()->toArray();
    $requestPost = $this->getRequest()->getPost()->toArray();
    $requestContent = json_decode($this->getRequest()->getContent(), true);

    $result = $this->_eisMobile->run($requestGet, $requestPost, $requestContent);

    return $this->getReturnResponse($result);

  }

  /**
   * Собираем ответ
   *
   * @param $jsonModelArr
   * @return \Zend\Stdlib\ResponseInterface
   */
  private function getReturnResponse($jsonModelArr) {

    $httpResponse = $this->getResponse();
    $httpResponse->setStatusCode(200);
    $httpResponse->getHeaders()->addHeaders(['Content-type' => 'application/json']);
    $view = new JsonModel($jsonModelArr);
    $httpResponse->setContent($view->serialize());

    return $httpResponse;
  }

  /**
   * Проверка авторизации и токена
   *
   * @return bool|\ZF\ApiProblem\ApiProblemResponse
   */
  private function checkAuthorization() {

    $server = call_user_func($this->serverFactory, "oauth");
    $isAuthorizationRequired = $this->getEvent()->getRouteMatch()->getParam('isAuthorizationRequired');

    if ($isAuthorizationRequired && !$server->verifyResourceRequest(OAuth2Request::createFromGlobals())) {
      // Логин не прошел
      $response = $server->getResponse();
      return $this->getApiProblemResponse($response);
    }

    return false;
  }
}
