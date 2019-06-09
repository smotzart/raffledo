<?php

namespace Multiple\Frontend\Controllers;

use Phalcon\Mvc\Controller;
use Raffledo\Models\Settings;

class ControllerBase extends Controller
{

  public function beforeExecuteRoute()
  {
    $user = $this->auth->getUser();
    if (!$user && $this->auth->hasRememberMe()) {
      return $this->auth->loginWithRememberMe();
    }
  }

  public function initialize()
  {    
    $settings = Settings::findFirst();
    if ($this->auth->getUser()) {
      $this->view->google = $settings->google_tag;
    }
    $this->tag->setTitle($settings->title);
    $this->view->description = $settings->description;
  }

}
