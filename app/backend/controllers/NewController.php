<?php

namespace Multiple\Backend\Controllers;

use Raffledo\Models\NewGames;
use Phalcon\Mvc\Controller;

class NewController extends Controller
{

  public function indexAction()
  {
    $this->view->newGames = NewGames::find();
  }

  public function viewAction($id)
  {
    $newGame = NewGames::findFirstById($id);

    if (!$newGame) {
      $this->flashSession->error("Entry was not found");
      return $this->dispatcher->forward([
        'action' => 'index'
      ]);
    }

    $this->view->newGame = $newGame;
  }

  public function deleteAction($id)
  {
    $newGame = NewGames::findFirstById($id);

    if (!$newGame) {
      $this->flashSession->error("Entry was not found");
      return $this->dispatcher->forward([
        'action' => 'index'
      ]);
    }

    if (!$newGame->delete()) {
      $this->flashSession->error($newGame->getMessages());
    } else {
      $this->flashSession->success("Entry was deleted");
    }

    return $this->dispatcher->forward([
      'action' => 'index'
    ]);
  }

}