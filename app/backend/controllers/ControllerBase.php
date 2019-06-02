<?php

namespace Multiple\Backend\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Dispatcher;

class ControllerBase extends Controller
{
  /**
   * Execute before the router so we can determine if this is a private controller, and must be authenticated, or a
   * public controller that is open to all.
   *
   * @param Dispatcher $dispatcher
   * @return boolean
   */
  public function beforeExecuteRoute(Dispatcher $dispatcher)
  {
   
    $user = $this->auth->getUser();
    $controllerName = $dispatcher->getControllerName();

    if (!$user || $user->profile->role == 'user') {
      $url = "http://" . $_SERVER['HTTP_HOST'];  
      header('Location: ' . $url, true, 302);
      die();
    }

    if ($controllerName == 'settings' && $user->profile->role != 'super') {
      $this->flashSession->error("You don't have permissions to enter this page");
      $this->response->redirect('');
    }

    return;
  }
}