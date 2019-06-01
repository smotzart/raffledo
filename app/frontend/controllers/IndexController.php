<?php

namespace Multiple\Frontend\Controllers;

use Raffledo\Forms\RegisterForm;
use Raffledo\Forms\LoginForm;
use Raffledo\Auth\Exception as AuthException;
use Phalcon\Filter;

use Raffledo\Models\Companies;
use Raffledo\Models\Users;


class IndexController extends ControllerBase
{

    /**
     * Default action. Set the public layout (layouts/public.volt)
     */
    public function initialize()
    {
      //parent::initialize();
      if ($this->auth->hasRememberMe()) {
        return $this->auth->loginWithRememberMe();
      }
    }

    public function indexAction()
    {

      if (is_array($this->auth->getIdentity())) {
        return $this->response->redirect('gewinnspiele');
      }

      $this->view->setVar('logged_in', is_array($this->auth->getIdentity()));

      $form = new RegisterForm();

      if ($this->request->isPost()) {

        if ($form->isValid($this->request->getPost()) == false) {

          foreach ($form->getMessages() as $message) {
            $this->flashSession->error($message);
          }
        } else {       

          $user = new Users([
            'username' => $this->request->getPost('username', 'striptags'),
            'email' => $this->request->getPost('email'),
            'password' => $this->security->hash($this->request->getPost('password')),
            'profiles_id' => 2
          ]);

          if (!$user->save()) {
            foreach ($user->getMessages() as $message) {
              $this->flashSession->error($message);
            }
          } else {
            $this->auth->check([
              'username' => $user->username,
              'password' => $this->request->getPost('password'),
              'remember' => 'yes'
            ]);

            return $this->response->redirect('gewinnspiele');
          }
         
        }
      }

      $this->view->form = $form;

    }

    public function tagsAction()     
    {      
      $filter = new Filter();
      $game_id = $filter->sanitize($_GET['games_id'], 'striptags');

      $phql = 'SELECT t.* FROM Raffledo\Models\Tags AS t INNER JOIN Raffledo\Models\GamesTags AS gt ON gt.tags_id = t.id WHERE gt.games_id= :game_id:';
      $tags = $this->modelsManager->executeQuery($phql, [
        'game_id' => $game_id
      ]);

      $data = [];

      foreach ($tags as $tag) {
        $data[] = [
          'id'   => $tag->id,
          'name' => $tag->name,
        ];
      }

      $this->view->disable();

      echo json_encode($data);
    }

    public function route404Action()
    {
      
    }
}

