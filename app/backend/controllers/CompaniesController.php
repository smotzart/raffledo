<?php

namespace Multiple\Backend\Controllers;

use Raffledo\Forms\CompaniesForm;
use Raffledo\Models\Companies;

class CompaniesController extends ControllerBase
{

    public function initialize()
    {
    }


    public function indexAction()
    {
      $this->view->companies = Companies::find();
    }

    public function createAction()
    {
      $form = new CompaniesForm(null);

      if ($this->request->isPost()) {

        if ($form->isValid($this->request->getPost()) == false) {                
          foreach ($form->getMessages() as $message) {
            $this->flash->error($message);
          }            
        } else {
          $company = new Companies([
            'name' => $this->request->getPost('name', 'striptags'),
            'tag' => $this->request->getPost('tag', 'striptags'),
            'host' => $this->request->getPost('host', 'striptags'),
            'footer' => $this->request->getPost('footer') ? 1 : 0
          ]);

          if (!$company->save()) {
            $this->flash->error($company->getMessages());
          } else {
            $this->flashSession->success("Company was created successfully");
            return $this->response->redirect('companies');
          }
        }
      }

      $this->view->form = $form;
    }

    public function editAction($id)
    {
      $company = Companies::findFirstById($id);

      if (!$company) {
        $this->flashSession->error("Company was not found");
        return $this->dispatcher->forward([
          'action' => 'index'
        ]);
      }

      $form = new CompaniesForm($company, [
        'edit' => true
      ]);

      if ($this->request->isPost()) {

        if ($form->isValid($this->request->getPost()) == false) {                
          foreach ($form->getMessages() as $message) {
            $this->flash->error($message);
          }            
        } else {
          $company->assign([
            'name' => $this->request->getPost('name', 'striptags'),
            'tag' => $this->request->getPost('tag', 'striptags'),
            'host' => $this->request->getPost('host', 'striptags'),
            'footer' => $this->request->getPost('footer') ? 1 : 0
          ]);

          if (!$company->save()) {
            $this->flash->error($company->getMessages());
          } else {
            $this->flashSession->success("Company was updated successfully");
            return $this->response->redirect('companies');
          }
        }
      }

      $this->view->form = $form;
      $this->view->company = $company;

    }

    public function deleteAction($id)
    {
      $company = Companies::findFirstById($id);

      if (!$company) {
        $this->flashSession->error("Company was not found");
        return $this->dispatcher->forward([
          'action' => 'index'
        ]);
      }

      if (!$company->delete()) {
        $this->flashSession->error($company->getMessages());
      } else {
        $this->flashSession->success("Tag was deleted");
      }

      return $this->dispatcher->forward([
        'action' => 'index'
      ]);
    }
}

