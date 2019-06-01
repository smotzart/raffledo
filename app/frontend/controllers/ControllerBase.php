<?php

namespace Multiple\Frontend\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Dispatcher;

use Raffledo\Models\Companies;


class ControllerBase extends Controller
{
  public function initialize()
  {
    //$this->view->logged_id = is_array($this->auth->getIdentity());
    $this->cookies->get('PHPSESSID')->delete();
    exit("asd");
  }
}
