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
    $user = $this->auth->getUser();

    if (!$user) {
      return  $this->flash->error('Only registered users have access to this page!');
    }
  }
  
  public function indexAction()
  {

    $user = $this->auth->getUser();
    if ($user) {
      $this->view->notification = $user->notify;
      $this->view->saved      = $user->savedGames;
      $this->view->hidden     = $user->hiddenGames;
      $this->view->companies  = $user->hiddenCompany;
      $this->view->tags       = $user->hiddenTags;
      $this->view->viewed     = $user->viewedGames;
    }
  
  }

  public function undoAction($type, $value)
  {
    $user = $this->auth->getUser();

    switch ($type) {
      case "notify":
        $user->notify = 1;
        $user->save();
        break;
      case "save":
        $item = SavedGames::findFirst($value);
        break;
      case "hide":
        $item = HiddenGames::findFirst($value);
        break;
      case "company":
        $item = HiddenCompanies::findFirst($value);
        break;
      case "tag":
        $item = HiddenTags::findFirst($value);
        break;
      case "view":
        $item = ViewedGames::findFirst($value);
        break;
    }

    if ($type == 'notify') {
      $this->flashSession->success("Notification messagse enable");

    } else {
      if (!$item) {
        $this->flashSession->error("Can't find selected entry");
      } else {
        if (!$item->delete()) {
          $this->flashSession->error("Can't delete selected entry");
        } else {
          $this->flashSession->success("Selected entry was successfully restore");
        }
      }
    }

    return $this->dispatcher->forward([
      'action' => 'index'
    ]);
  }
  
}
