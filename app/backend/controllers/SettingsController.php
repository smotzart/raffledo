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
            'entry_amount'        => $this->request->getPost('entry_amount', 'striptags'),
            'deadline_time'       => $this->request->getPost('deadline_time', 'striptags'),
            'enter_time'          => $this->request->getPost('enter_time', 'striptags'),
            'google_tag'          => $this->request->getPost('google_tag'),
            'ads_regular'         => $this->request->getPost('ads_regular'),
            'ads_register'        => $this->request->getPost('ads_register'),
            'title'               => $this->request->getPost('title', 'striptags'),
            'description'         => $this->request->getPost('description', 'striptags'),
            'title_game'          => $this->request->getPost('title_game', 'striptags'),
            'description_game'    => $this->request->getPost('description_game', 'striptags'),
            'title_tag'           => $this->request->getPost('title_tag', 'striptags'),
            'description_tag'     => $this->request->getPost('description_tag', 'striptags'),
            'title_company'       => $this->request->getPost('title_company', 'striptags'),
            'description_company' => $this->request->getPost('description_company', 'striptags')
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

