<?php

namespace Multiple\Backend\Controllers;

use Raffledo\Forms\TagsForm;
use Multiple\Frontend\Models\Tags;

class TagsController extends ControllerBase
{

    public function initialize()
    {
    }


    public function indexAction()
    {
      $this->view->tags = Tags::find();
    }

    public function createAction()
    {
      $form = new TagsForm(null);

      if ($this->request->isPost()) {

        if ($form->isValid($this->request->getPost()) == false) {                
          foreach ($form->getMessages() as $message) {
            $this->flash->error($message);
          }            
        } else {
          $tag = new Tags([
            'tag' => $this->request->getPost('tag', 'striptags'),
            'title' => $this->request->getPost('title', 'striptags'),
            'description' => $this->request->getPost('description', 'striptags'),
            'footer' => $this->request->getPost('footer') ? 1 : 0
          ]);

          if (!$tag->save()) {
            $this->flashSession->error($tag->getMessages());
          } else {
            $this->flashSession->success("Tag was created successfully");
          }

          return $this->response->redirect('tags');
        }
      }

      $this->view->form = $form;
    }

    public function editAction($id)
    {
      $tag = Tags::findFirstById($id);

      if (!$tag) {
        $this->flashSession->error("Tag was not found");
        return $this->dispatcher->forward([
          'action' => 'index'
        ]);
      }

      $form = new TagsForm($tag, [
        'edit' => true
      ]);

      if ($this->request->isPost()) {

        if ($form->isValid($this->request->getPost()) == false) {                
          foreach ($form->getMessages() as $message) {
            $this->flash->error($message);
          }            
        } else {
          $tag->assign([
            'tag' => $this->request->getPost('tag', 'striptags'),
            'title' => $this->request->getPost('title', 'striptags'),
            'description' => $this->request->getPost('description', 'striptags'),
            'footer' => $this->request->getPost('footer') ? 1 : 0
          ]);

          if (!$tag->save()) {
            $this->flashSession->error($tag->getMessages());
          } else {
            $this->flashSession->success("Tag was updated successfully");
          }

          return $this->response->redirect('tags');
        }
      }

      $this->view->form = $form;
      $this->view->itemTag = $tag;

    }

    public function deleteAction($id)
    {
      $tag = Tags::findFirstById($id);

      if (!$tag) {
        $this->flashSession->error("Tag was not found");
        return $this->dispatcher->forward([
          'action' => 'index'
        ]);
      }

      if (!$tag->delete()) {
        $this->flashSession->error($tag->getMessages());
      } else {
        $this->flashSession->success("Tag was deleted");
      }

      return $this->dispatcher->forward([
        'action' => 'index'
      ]);
    }
}

