<?php

namespace Multiple\Backend\Controllers;

use Raffledo\Forms\SettingsForm;
use Raffledo\Models\Settings;

class SettingsController extends ControllerBase
{

    public function initialize()
    {
    }


    public function indexAction()
    {

      $setting = Settings::findFirst();

      if (!$setting) {
        $this->flashSession->error("Settings was not found");
        return $this->dispatcher->forward([
          'controller' => 'games',
          'action' => 'index'
        ]);
      }

      $form = new SettingsForm($setting);

      if ($this->request->isPost()) {

        if ($form->isValid($this->request->getPost()) == false) {                
          foreach ($form->getMessages() as $message) {
            $this->flash->error($message);
          }            
        } else {
          $setting->assign([
            'entry_amount'  => $this->request->getPost('entry_amount', 'striptags'),
            'deadline_time' => $this->request->getPost('deadline_time', 'striptags'),
            'enter_time'    => $this->request->getPost('enter_time', 'striptags')
          ]);

          if (!$setting->save()) {
            $this->flash->error($setting->getMessages());
          } else {
            $this->flash->success("Settings was updated successfully");
          }
        }
      }

      $this->view->form = $form;
    }

}

