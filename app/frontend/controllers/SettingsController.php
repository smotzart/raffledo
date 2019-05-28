<?php

namespace Multiple\Frontend\Controllers;

use Phalcon\Mvc\Controller;

use Raffledo\Models\HiddenCompanies;
use Raffledo\Models\HiddenGames;
use Raffledo\Models\HiddenTags;
use Raffledo\Models\ViewedGames;
use Raffledo\Models\SavedGames;


class SettingsController extends ControllerBase
{
  public function initialize()
  {
  }
  
  public function indexAction()
  {
    $user = $this->auth->getUser();

    if (!$user) {
      return  $this->flash->error('Only registered users have access to this page!');
    }

    $this->view->saved      = $user->savedGames;
    $this->view->hidden     = $user->hiddenGames;
    $this->view->companies  = $user->hiddenCompany;
    $this->view->tags       = $user->hiddenTags;
    $this->view->viewed     = $user->viewedGames;

  }
  
}
