<?php

namespace Multiple\Backend\Controllers;

use Raffledo\Forms\CompaniesForm;
use Raffledo\Models\Companies;
use Phalcon\Filter;

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
            $this->flash->success("Company was updated successfully");
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
        foreach ($company->getMessages() as $message) {
          $this->flashSession->error($message);
        } 
      } else {
        $this->flashSession->success("Tag was deleted");
      }

      return $this->dispatcher->forward([
        'action' => 'index'
      ]);
    }

    public function searchAction($search = '') {
      $this->view->disable();

      $filter = new Filter();
      $search = $filter->sanitize($_GET['search'], ['striptags', 'trim']);

      $search_url = parse_url($search);
      $search_url = isset($search_url['host']) ? $search_url['host'] : $search_url['path'];

      $company = Companies::findFirst([
        "conditions" => "host LIKE '%" . $search_url . "%'"
      ]);

      if (!$company) {
        $host = parse_url($search, PHP_URL_HOST);
        if ($host) {
          $tag  = explode('.', $host);
          $tag  = count($tag) > 1 ? $tag[count($tag) - 2] : $search;  
        } else {
          $tag = $search;
        }
        
        $result['new'] = array(
          'name' => '',
          'host' => $host,
          'tag'  => $tag
        );

      }

      $result['company'] = $company;
      $result['games'] = $company->games;


      return $this->response->setContent(json_encode($result));
    }
}

