<?php

namespace Multiple\Frontend\Controllers;

use Raffledo\Forms\LoginForm;
use Raffledo\Auth\Exception as AuthException;

class SessionController extends ControllerBase
{
  public function initialize()
  {
  }

  public function indexAction()
  {
  }

  public function loginAction()
  {
    $form = new LoginForm();

    try {
      if (!$this->request->isPost()) {
        if ($this->auth->hasRememberMe()) {
          return $this->auth->loginWithRememberMe();
        } 
      } else {
        if ($form->isValid($this->request->getPost()) == false) {
          foreach ($form->getMessages() as $message) {
            $this->flashSession->error($message);
          }
        } else {
          $this->auth->check([
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password'),
            'remember' => 'yes'
          ]);
          return $this->response->redirect('gewinnspiele');
        }
      }
    } catch (AuthException $e) {
      $this->flashSession->error($e->getMessage());
    }
    $this->view->form = $form;
  }

  public function logoutAction()
  {
    $this->auth->remove();
    return $this->response->redirect('/');
  }
}

