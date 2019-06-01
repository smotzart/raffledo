<?php

namespace Multiple\Frontend\Controllers;

use Phalcon\Mvc\Controller;

class PolicyController extends Controller
{

  public function indexAction()
  {
    setlocale(LC_TIME, "de_DE");
  echo strftime(" по-немецки - %A.\n");
  exit();
    
  }

}

