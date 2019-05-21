<?php

namespace Multiple\Frontend\Controllers;

use Raffledo\Forms\RegisterForm;
use Raffledo\Forms\LoginForm;
use Raffledo\Auth\Exception as AuthException;

use Multiple\Frontend\Models\Companies;

class IndexController extends ControllerBase
{

    /**
     * Default action. Set the public layout (layouts/public.volt)
     */
    public function initialize()
    {
      parent::initialize();
    }

    public function indexAction()
    {
      $this->view->setVar('logged_in', is_array($this->auth->getIdentity()));

      $form = new RegisterForm();

      if ($this->request->isPost()) {

        if ($form->isValid($this->request->getPost()) != false) {

          $user = new Users([
            'name' => $this->request->getPost('name', 'striptags'),
            'email' => $this->request->getPost('email'),
            'password' => $this->security->hash($this->request->getPost('password')),
            'profiles_id' => 2
          ]);

          if ($user->save()) {
            return $this->dispatcher->forward([
              'controller' => 'index',
              'action' => 'index'
            ]);
          }

          $this->flash->error($user->getMessages());
        }
      }

      $this->view->form = $form;

    }

}

