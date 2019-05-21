<?php

namespace Multiple\Frontend\Controllers;

use Raffledo\Forms\GamesForm;
use Multiple\Frontend\Models\Games;
use Multiple\Frontend\Models\Tags;
use Multiple\Frontend\Models\Companies;

class GamesController extends ControllerBase
{

  public function initialize()
  {
    $this->view->logged_in = is_array($this->auth->getIdentity());    
  }

  public function indexAction()
  {
    $this->view->games = Games::find();
  }


  public function searchAction()
  {
    $search = $this->dispatcher->getParam('search');
    $tag    = Tags::findFirst(['tag = ?0', 'bind' => [$search]]);
    
    $this->view->games = $tag->games;
  }


}

