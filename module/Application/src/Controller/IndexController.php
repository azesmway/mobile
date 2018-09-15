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

class IndexController extends AuthController
{

  /**
   * IndexController constructor.
   * @param $serverFactory
   * @param UserIdProviderInterface $userIdProvider
   */
  public function __construct($serverFactory, UserIdProviderInterface $userIdProvider)
  {
    parent::__construct($serverFactory, $userIdProvider);
  }

  /**
   * @return \Zend\Stdlib\ResponseInterface|\Zend\View\Model\ViewModel|\ZF\ApiProblem\ApiProblemResponse
   */
  public function indexAction()
  {

    $server = call_user_func($this->serverFactory, "oauth");
    $isAuthorizationRequired = $this->getEvent()->getRouteMatch()->getParam('isAuthorizationRequired');

    if ($isAuthorizationRequired && !$server->verifyResourceRequest(OAuth2Request::createFromGlobals())) {
      // Логин не прошел
      $response = $server->getResponse();
      return $this->getApiProblemResponse($response);
    }

    $httpResponse = $this->getResponse();
    $httpResponse->setStatusCode(200);
    $httpResponse->getHeaders()->addHeaders(['Content-type' => 'application/json']);
    $httpResponse->setContent(
      json_encode(['success' => true, 'message' => 'You accessed to EISMobile!'])
    );

    return $httpResponse;

  }
}
