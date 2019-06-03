<?php

namespace Multiple\Frontend\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Dispatcher;

use Raffledo\Models\Companies;


class ControllerBase extends Controller
{

  /**
   * Execute before the router so we can determine if this is a private controller, and must be authenticated, or a
   * public controller that is open to all.
   *
   * @param Dispatcher $dispatcher
   * @return boolean
   */
  public function beforeExecuteRoute()
  {
    $user = $this->auth->getUser();
    if (!$user && $this->auth->hasRememberMe()) {
      return $this->auth->loginWithRememberMe();
    }
  }

  public function initialize()
  {    
  }

}
