<?php

namespace Multiple\Frontend\Controllers;

use Raffledo\Forms\GamesForm;
use Raffledo\Models\Games;
use Raffledo\Models\Tags;
use Raffledo\Models\SavedGames;
use Raffledo\Models\HiddenGames;
use Raffledo\Models\Companies;
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class GamesController extends ControllerBase
{

  public function initialize()
  {
    $this->view->companies_footer = $this->modelsManager->createBuilder()
      ->from(['companies' => 'Raffledo\Models\Companies'])
      ->leftJoin('Raffledo\Models\Games', 'games.companies_id = companies.id', 'games')
      ->where('companies.footer = 1')
      ->having('count(games.id) > 0')
      ->groupBy('companies.id')
      ->limit(8)
      ->getQuery()->execute();

    $this->view->tags_footer= Tags::find(['limit' => 4, 'footer=1']); 

    $this->view->setTemplateBefore('list');
    $this->view->logged_in = is_array($this->auth->getIdentity()); 
    
    if ($this->dispatcher->getParam('tag')) {
      $tag = Tags::findFirst(['tag = ?0', 'bind' => [$this->dispatcher->getParam('tag')]]);
      if (!$tag) {
        $this->flashSession->error("Tag was not found");
        return $this->response->redirect('gewinnspiele');
      }
      $search_name = $tag->name;
      $this->view->search_description = $tag->description;
    } elseif ($this->dispatcher->getParam('company')) {
      $company = Companies::findFirst(['tag = ?0', 'bind' => [$this->dispatcher->getParam('company')]]);
      if (!$company) {
        $this->flashSession->error("Company was not found");
        return $this->response->redirect('gewinnspiele');        
      }
      $search_name = $company->name;
    } else {
      $search_name = '';
    }
    $this->view->search_name = $search_name;

  }

  public function indexAction()
  {
    $numberPage = 1;
    $user = $this->auth->getUser();

    if ($user) {
      $numberPage = $this->request->getQuery("page", "int");

      if ($this->request->isPost()) {
        $user = $this->auth->getUser();
        $game = $this->request->getPost('actionId', 'int');
        $type = $this->request->getPost('actionType', 'striptags');

        if ($type == 'save') {
          $proc_game = SavedGames::findFirst(['games_id = ' . $game . ' AND users_id = ' . $user->id]);
          if ($proc_game) {
            $proc_game->delete();
          } else {
            $new = new SavedGames(['games_id' => $game, 'users_id' => $user->id]);
            $new->save();
          }          
        }

        if ($type == 'hide') {
          $proc_game = HiddenGames::findFirst(['games_id = ' . $game . ' AND users_id = ' . $user->id]);
          if ($proc_game) {
            $proc_game->delete();
          } else {
            $new = new HiddenGames(['games_id' => $game, 'users_id' => $user->id]);
            $new->save();
          }          
        }  
        return $this->response->redirect($_SERVER['HTTP_REFERER']);
      }
    }

    

    if ($this->dispatcher->getParam('tag')) {

      $tag = Tags::findFirst(['tag = ?0', 'bind' => [$this->dispatcher->getParam('tag')]]);
      if (!$tag) {
        return $this->flashSession->error("Can't find choosen tag");
      }
      //$games = $tag ? $tag->games : Games::find();
      $games = $this->modelsManager->createBuilder()
        ->from(['games' => 'Raffledo\Models\Games'])
        ->leftJoin('Raffledo\Models\GamesTags', 'gt.games_id = games.id', 'gt')
        ->leftJoin('Raffledo\Models\SavedGames', 'saved.games_id = games.id', 'saved')
        ->leftJoin('Raffledo\Models\HiddenGames', 'hidden.games_id = games.id', 'hidden')
        ->where('gt.tags_id = '.$tag->id.' AND saved.id IS NULL AND hidden.id IS NULL')
        ->getQuery()
        ->execute();      

    } elseif ($this->dispatcher->getParam('company')) {

      $company = Companies::findFirst(['tag = ?0', 'bind' => [$this->dispatcher->getParam('company')]]);
      if (!$company) {
        return $this->flashSession->error("Can't find choosen company");
      }
      //$games = $company ? $company->games : Games::find();
      $games = $this->modelsManager->createBuilder()
        ->from(['games' => 'Raffledo\Models\Games'])
        ->leftJoin('Raffledo\Models\SavedGames', 'saved.games_id = games.id', 'saved')
        ->leftJoin('Raffledo\Models\HiddenGames', 'hidden.games_id = games.id', 'hidden')
        ->where('games.companies_id = '.$company->id.' AND saved.id IS NULL AND hidden.id IS NULL')
        ->getQuery()
        ->execute();

    } else {

      if ($user) {
        $games = $this->modelsManager->createBuilder()
          ->from(['games' => 'Raffledo\Models\Games'])
          ->leftJoin('Raffledo\Models\SavedGames', 'saved.games_id = games.id', 'saved')
          ->leftJoin('Raffledo\Models\HiddenGames', 'hidden.games_id = games.id', 'hidden')
          ->where('saved.id IS NULL AND hidden.id IS NULL')
          ->getQuery()
          ->execute();
      } else {
        $games = $this->modelsManager->createBuilder()
          ->from(['games' => 'Raffledo\Models\Games'])
          ->leftJoin('Raffledo\Models\HiddenGames', 'hidden.games_id = games.id', 'hidden')
          ->where('hidden.id IS NULL')
          ->limit(5)
          ->getQuery()
          ->execute();
      }

    }
    
    
   

    $paginator = new Paginator([
      "data"  => $games,
      "limit" => 5,
      "page"  => $numberPage
    ]);

    $this->view->page = $paginator->getPaginate();

  }

  public function showAction($id) {
    $game = Games::findFirst($id);
    return $this->response->redirect($game->url, true, 302);
  }

  public function favoriteAction() {

    $this->view->setTemplateBefore('favorite');

    if (!is_array($this->auth->getIdentity())) {
      return $this->dispatcher->forward([
        "action" => "index"
      ]);
    }

    $user = $this->auth->getUser();

    $games = $this->modelsManager->createBuilder()
      ->from(['games' => 'Raffledo\Models\Games'])
      ->leftJoin('Raffledo\Models\SavedGames', 'saved.games_id = games.id', 'saved')
      ->leftJoin('Raffledo\Models\HiddenGames', 'hidden.games_id = games.id', 'hidden')
      ->where('saved.users_id = '.$user->id.' AND hidden.id IS NULL')
      ->getQuery()
      ->execute();

    $numberPage = 1;
    $numberPage = $this->request->getQuery("page", "int");

    $paginator = new Paginator([
      "data"  => $games,
      "limit" => 5,
      "page"  => $numberPage
    ]);

    $this->view->page = $paginator->getPaginate();

  }

  public function controlAction()
  {
    $user = $this->auth->getUser();

    if ($user) {

      if ($this->request->isPost()) {
        $game = $this->request->getPost('actionId', 'int');
        $type = $this->request->getPost('actionType', 'striptags');

        if ($type == 'save') {
          $proc_game = SavedGames::findFirst(['games_id = ' . $game . ' AND users_id = ' . $user->id]);
          if ($proc_game) {
            $proc_game->delete();
          } else {
            $new = new SavedGames(['games_id' => $game, 'users_id' => $user->id]);
            if (!$new->save()) {
              $this->flashSession->error("Can't save game to favoriten list");
            }
          }          
        }

        if ($type == 'hide') {
          $proc_game = HiddenGames::findFirst(['games_id = ' . $game . ' AND users_id = ' . $user->id]);
          if ($proc_game) {
            $proc_game->delete();
          } else {
            $new = new HiddenGames(['games_id' => $game, 'users_id' => $user->id]);
            if (!$new->save()) {              
              $this->flashSession->error("Can't hide game");
            }
          }          
        } 
        $url = explode('?', $this->request->getHTTPReferer());
        return $this->response->redirect($url[0]);        
      }

    } else {
      $this->flashSession->error("Only register user can do this action");
    }

    $this->view->disable();

    return false;
  }

}

