<?php

namespace Multiple\Frontend\Controllers;

use Raffledo\Forms\NewGameForm;
use Raffledo\Models\NewGames;
use Phalcon\Mvc\Controller;

class NewController extends Controller
{

  public function indexAction()
  {
    $form = new NewGameForm();

    if ($this->request->isPost()) {

      if ($form->isValid($this->request->getPost()) == false) {                
        foreach ($form->getMessages() as $message) {
          $this->flash->error($message);
        }            
      } else {
        $new_game = new NewGames([
          'company' => $this->request->getPost('company', 'striptags'),
          'url' => $this->request->getPost('url', 'striptags'),
          'text1' => $this->request->getPost('text1', 'striptags'),
          'text2' => $this->request->getPost('text2', 'striptags')
        ]);

        if (!$new_game->save()) {
          $this->flash->error($new_game->getMessages());
        } else {
          $this->flashSession->success("Gewinnspielformular was created successfully");
          return $this->response->redirect('neues');
        }
      }
    }

    $this->view->form = $form;
  }

}

