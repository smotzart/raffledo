<?php

namespace Multiple\Frontend\Controllers;

use Phalcon\Mvc\Controller;
use Raffledo\Models\HiddenCompanies;
use Raffledo\Models\HiddenGames;
use Raffledo\Models\HiddenTags;
use Raffledo\Models\HiddenTypes;
use Raffledo\Models\ViewedGames;
use Raffledo\Models\SavedGames;
use Raffledo\Forms\UserSettingsForm;


class SettingsController extends ControllerBase
{
  public function initialize()
  {
    $user = $this->auth->getUser();
    parent::initialize();
    if (!$user) {
      return  $this->flash->error('Only registered users have access to this page!');
    }
  }
  
  public function indexAction()
  {
    $user = $this->auth->getUser();
    
    $form = new UserSettingsForm(null, [
      'sort_type' => $user->sort_type,
      'notify' => $user->notify
    ]);

    $this->view->form = $form; 

    if ($user) {
      $this->view->notification = $user->notify;
      $this->view->saved      = $user->savedGames;
      $this->view->hidden     = $user->hiddenGames;
      $this->view->types      = $user->hiddenTypes;
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
      case "type":
        $item = HiddenTypes::findFirst($value);
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
  
  public function userAction()
  {
    if ($this->request->isPost()) {
      $user = $this->auth->getUser();
      $user->assign([
        'sort_type' => $this->request->getPost('sort_type', ['striptags', 'int']),
        'notify' => $this->request->getPost('notify', ['striptags', 'int'])
      ]);
      if ($user->save()) {
        $this->flashSession->success("Einstellungen updated");
      }
    }
    return $this->dispatcher->forward([
      'action' => 'index'
    ]);
  }
}
