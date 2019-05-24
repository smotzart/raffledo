<?php

namespace Multiple\Backend\Controllers;

use Raffledo\Forms\GamesForm;
use Raffledo\Models\Games;
use Raffledo\Models\Tags;
use Raffledo\Models\GamesTags;
use Raffledo\Models\Companies;
use Phalcon\Filter;

class GamesController extends ControllerBase
{

    public function initialize()
    {
    }

    public function indexAction()
    {
      $this->view->games = Games::find();
    }

    public function createAction()
    {
      $form = new GamesForm(null);

      if ($this->request->isPost()) {

        if ($form->isValid($this->request->getPost()) == false) {                
          foreach ($form->getMessages() as $message) {
            $this->flash->error($message);
          }            
        } else {
          $game = new Games([
            'url' => $this->request->getPost('url', 'striptags'),
            //'companies_id' => $this->request->getPost('companies_id'),
            'title' => $this->request->getPost('title', 'striptags'),
            'price' => $this->request->getPost('price', 'striptags'),
            'type_register' => $this->request->getPost('type_register') ? 1 : 0,
            'type_sms' => $this->request->getPost('type_sms') ? 1 : 0,
            'type_buy' => $this->request->getPost('type_buy') ? 1 : 0,
            'type_internet' => $this->request->getPost('type_internet') ? 1 : 0,
            'type_submission' => $this->request->getPost('type_submission') ? 1 : 0,
            'suggested_solution' => $this->request->getPost('suggested_solution', 'striptags'),
            'enter_date' => $this->request->getPost('enter_date'),
            'deadline_date' => $this->request->getPost('deadline_date'),
            'enter_time' => $this->request->getPost('enter_time'),
            'deadline_time' => $this->request->getPost('deadline_time')
          ]);

          if ($this->request->getPost('companies_id') == 'new') {
            $company = new Companies([
              'name' => $this->request->getPost('c_name', 'striptags'),
              'tag' => $this->request->getPost('c_tag', 'striptags'),
              'host' => $this->request->getPost('c_host', 'striptags')
            ]);
            $game->company = $company;
          } else {
            $game->companies_id = $this->request->getPost('companies_id');
          }

          $updated_tags = $this->request->getPost('tags_id');

          if ($updated_tags && count($updated_tags) > 0) {
            $tags = array();
            
            foreach($updated_tags as $tag_id) {
              $gt = new GamesTags([
                'tags_id' => $tag_id
              ]);
              $tags[] = $gt;
            }
            $game->gamesTags = $tags;
          }
          
          if (!$game->save()) {
            $this->flash->error($game->getMessages());
          } else {
            $this->flashSession->success("Game was created successfully");
            return $this->response->redirect('games');
          }
        }
      }

      $this->view->form = $form;
    }

    public function editAction($id)
    {
      $game = Games::findFirstById($id);

      $current_tags = array_map('current', $game->getRelated('tags', ['columns' => 'tags_id'])->toArray());
   
      if (!$game) {
        $this->flashSession->error("Game was not found");
        return $this->dispatcher->forward([
          'action' => 'index'
        ]);
      }

      $form = new GamesForm($game, [
        'edit' => true,
        'tags' => $current_tags
      ]);

      if ($this->request->isPost()) {

        if ($form->isValid($this->request->getPost()) == false) {                
          foreach ($form->getMessages() as $message) {
            $this->flash->error($message);
          }            
        } else {
          $game->assign([
            'url' => $this->request->getPost('url', 'striptags'),
            'companies_id' => $this->request->getPost('companies_id'),
            'title' => $this->request->getPost('title', 'striptags'),
            'price' => $this->request->getPost('price', 'striptags'),
            'type_register' => $this->request->getPost('type_register') ? 1 : 0,
            'type_sms' => $this->request->getPost('type_sms') ? 1 : 0,
            'type_buy' => $this->request->getPost('type_buy') ? 1 : 0,
            'type_internet' => $this->request->getPost('type_internet') ? 1 : 0,
            'type_submission' => $this->request->getPost('type_submission') ? 1 : 0,
            'suggested_solution' => $this->request->getPost('suggested_solution', 'striptags'),
            'enter_date' => $this->request->getPost('enter_date'),
            'deadline_date' => $this->request->getPost('deadline_date'),
            'enter_time' => $this->request->getPost('enter_time'),
            'deadline_time' => $this->request->getPost('deadline_time')
          ]);      

          $updated_tags = $this->request->getPost('tags_id');

          $tags = array();
          $game->getGamesTags()->delete();
          
          if ($updated_tags && count($updated_tags) > 0) {
          
            foreach($updated_tags as $tag_id) {
              $gt = new GamesTags([
                'tags_id' => $tag_id
              ]);
              $tags[] = $gt;
            }
            $game->gamesTags = $tags;
          }

          if (!$game->save()) {
            $this->flash->error($game->getMessages());
          } else {   
            $this->flashSession->success("Game was updated successfully");
            return $this->response->redirect('games');
          }          
        }
      }

      $this->view->form = $form;
      $this->view->game = $game;

    }

    public function deleteAction($id)
    {
      $game = Games::findFirstById($id);

      if (!$game) {
        $this->flashSession->error("Game was not found");
        return $this->dispatcher->forward([
          'action' => 'index'
        ]);
      }

      if (!$game->delete()) {
        $this->flashSession->error($game->getMessages());
      } else {
        $this->flashSession->success("Game was deleted");
      }

      return $this->dispatcher->forward([
        'action' => 'index'
      ]);
    }

    public function searchAction($search = '') {
      $this->view->disable();

      $filter = new Filter();
      $search = $filter->sanitize($_GET['search'], 'striptags');

      $search_url = parse_url($search);
      $search_url = isset($search_url['host']) ? $search_url['host'] : $search_url['path'];

      $games = Games::find([
        "conditions" => "url LIKE '%" . $search_url . "%'"
      ]);

      return $this->response->setContent(json_encode($games));
    }
}

