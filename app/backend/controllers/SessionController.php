<?php

namespace Multiple\Backend\Controllers;

use Raffledo\Forms\LoginForm;
use Raffledo\Auth\Exception as AuthException;

class SessionController extends ControllerBase
{

    /**
     * Default action. Set the public layout (layouts/public.volt)
     */
    public function initialize()
    {
    }

    public function indexAction()
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
              'email' => $this->request->getPost('email'),
              'password' => $this->request->getPost('password'),
              'remember' => $this->request->getPost('remember')
            ]);

            return $this->response->redirect('games');
          }
        }
      } catch (AuthException $e) {
        $this->flashSession->error($e->getMessage());
      }

      $this->view->form = $form;
    }

    /**
     * Closes the session
     */
    public function logoutAction()
    {
        $this->auth->remove();
        $url = "http://" . $_SERVER['HTTP_HOST'];  
        header('Location: ' . $url, true, 302);
        die();

    }
}

