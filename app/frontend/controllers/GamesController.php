<?php

namespace Multiple\Frontend\Controllers;

use Raffledo\Forms\GamesForm;
use Raffledo\Forms\ReportForm;
use Raffledo\Forms\RegisterForm;

use Raffledo\Models\Games;
use Raffledo\Models\SavedGames;
use Raffledo\Models\HiddenGames;
use Raffledo\Models\ViewedGames;

use Raffledo\Models\Tags;
use Raffledo\Models\Reports;
use Raffledo\Models\HiddenCompanies;
use Raffledo\Models\HiddenTags;
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
      ->leftJoin('Raffledo\Models\SavedGames', 'saved.games_id = games.id', 'saved')
      ->leftJoin('Raffledo\Models\HiddenGames', 'hidden.games_id = games.id', 'hidden')
      ->leftJoin('Raffledo\Models\HiddenCompanies', 'hc.companies_id = games.companies_id', 'hc')

      ->where('companies.footer = 1 AND saved.id IS NULL AND hidden.id IS NULL AND hc.id IS NULL')
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

    $this->view->report = new ReportForm();
    $this->view->regform = new RegisterForm();

  }

  public function indexAction()
  {
    $numberPage = 1;
    $user = $this->auth->getUser();

    if ($user) {
      $numberPage = $this->request->getQuery("page", "int");

      /*
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
      }*/
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
        ->leftJoin('Raffledo\Models\HiddenCompanies', 'hc.companies_id = games.companies_id', 'hc')
        ->where('gt.tags_id = '.$tag->id.' AND saved.id IS NULL AND hidden.id IS NULL AND hc.id IS NULL')
        ->getQuery()
        ->execute();      

    } elseif ($this->dispatcher->getParam('company')) {

      $company = Companies::findFirst(['tag = ?0', 'bind' => [$this->dispatcher->getParam('company')]]);
      if (!$company) {
        return $this->flashSession->error("Can't find choosen company");
      }

      $phql = 'SELECT g.*';
      $phql .= $user ? ' , hg.id as hide_id, hg.users_id as hide_user, sg.id as save_id, sg.users_id as save_user, vg.id as is_view' : '';
      $phql .= ' FROM Raffledo\Models\Games AS g';
      $phql .= $user ? ' LEFT JOIN Raffledo\Models\HiddenCompanies AS hc ON hc.companies_id = g.companies_id AND hc.users_id = ' . $user->id : '';
      $phql .= $user ? ' LEFT JOIN Raffledo\Models\HiddenGames AS hg ON hg.games_id = g.id AND hg.users_id = ' . $user->id : '';
      $phql .= $user ? ' LEFT JOIN Raffledo\Models\SavedGames AS sg ON sg.games_id = g.id AND sg.users_id = ' . $user->id : '';
      $phql .= $user ? ' LEFT JOIN Raffledo\Models\ViewedGames AS vg ON vg.games_id = g.id AND vg.users_id = ' . $user->id : '';      
      $phql .= $user ? ' WHERE hg.id IS NULL AND hc.id IS NULL AND g.companies_id = ' . $company->id : '';
      $phql .= $user ? ' ORDER BY save_id DESC' : '';
      $phql .= $user ? '' : ' LIMIT 5';

      $games = $this->modelsManager->executeQuery($phql);

    } else {

      $phql = 'SELECT g.*';
      $phql .= $user ? ' , hg.id as hide_id, hg.users_id as hide_user, sg.id as save_id, sg.users_id as save_user, vg.id as is_view' : '';
      $phql .= ' FROM Raffledo\Models\Games AS g';
      $phql .= $user ? ' LEFT JOIN Raffledo\Models\HiddenCompanies AS hc ON hc.companies_id = g.companies_id AND hc.users_id = ' . $user->id : '';
      $phql .= $user ? ' LEFT JOIN Raffledo\Models\HiddenGames AS hg ON hg.games_id = g.id AND hg.users_id = ' . $user->id : '';
      $phql .= $user ? ' LEFT JOIN Raffledo\Models\SavedGames AS sg ON sg.games_id = g.id AND sg.users_id = ' . $user->id : '';
      $phql .= $user ? ' LEFT JOIN Raffledo\Models\ViewedGames AS vg ON vg.games_id = g.id AND vg.users_id = ' . $user->id : '';      
      $phql .= $user ? ' WHERE hg.id IS NULL AND hc.id IS NULL' : '';
      $phql .= $user ? ' ORDER BY save_id DESC' : '';
      $phql .= $user ? '' : ' LIMIT 5';

      $games = $this->modelsManager->executeQuery($phql);

    }

    if (!$user) {
      $this->view->single_type = true;
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
    $user = $this->auth->getUser();

    if ($user && $game) {
      /*$hide = new HiddenGames([
        'games_id' => $game->id
      ]);*/
      $view = ViewedGames::findFirst([
        'games_id = :games_id: AND users_id = :users_id:',
        'bind' => [
          'games_id' => $game->id,
          'users_id' => $user->id
        ]
      ]);
      
      if (!$view) {
        $view = new ViewedGames([
          'games_id' => $game->id
        ]);
        
        //$user->hiddenGames = $hide;
        $user->viewedGames = $view;
        $user->save();   
      }
         
    }

    return $this->response->redirect($game->url, true, 302);
  }


  public function controlAction()
  {
    $user = $this->auth->getUser();

    if ($user) {

      if ($this->request->isPost()) {
        $game = Games::findFirst($this->request->getPost('actionId', 'int'));
        $type = $this->request->getPost('actionType', 'striptags');

        if ($type == 'save') {
          $proc_game = SavedGames::findFirst(['games_id = ' . $game->id . ' AND users_id = ' . $user->id]);
          if ($proc_game) {
            $proc_game->delete();
          } else {
            $new = new SavedGames(['games_id' => $game->id, 'users_id' => $user->id]);
            if (!$new->save()) {
              $this->flashSession->error("Can't save game to favoriten list");
            }
          }          
        }

        if ($type == 'hide') {
          $proc_game = HiddenGames::findFirst(['games_id = ' . $game->id . ' AND users_id = ' . $user->id]);
          if ($proc_game) {
            $proc_game->delete();
          } else {
            $new = new HiddenGames(['games_id' => $game->id, 'users_id' => $user->id]);
            if (!$new->save()) {              
              $this->flashSession->error("Can't hide game");
            }
          }          
        } 

        if ($type == 'hideCompany') {
          $entry = HiddenCompanies::findFirst(['companies_id = ' . $game->companies_id . ' AND users_id = ' . $user->id]);
          if ($entry) {
            $this->flashSession->error("This company is allredy hidden for you");
          } else {
            $new = new HiddenCompanies(['companies_id' => $game->companies_id, 'users_id' => $user->id]);
            if (!$new->save()) {              
              $this->flashSession->error("Can't hide company");
            }     
          }
        } 

        if ($type == 'hideTags') {
          $proc_tags = $this->request->getPost('tags_id');

          foreach ($proc_tags as $proc_tag) {
            $entry = HiddenTags::findFirst(['tags_id = ' . $proc_tag . ' AND users_id = ' . $user->id]);
            if ($entry) {
              $this->flashSession->error("Tag ".$entry->tag_entry->name." is allredy hidden for you");
            } else {
              $new = new HiddenTags(['tags_id' => $proc_tag, 'users_id' => $user->id]);
              if (!$new->save()) {              
                $this->flashSession->error("Can't hide tag");
              } else {                
                $this->flashSession->success("Tag ".$entry->tag_entry->name." successfully hide for you");
              }
            }
          }
        } 
        
        return $this->response->redirect('index');        
      }

    } else {
      $this->flashSession->error("Only register user can do this action");
    }

    $this->view->disable();

    return false;
  }


  public function reportAction()
  {
    $user = $this->auth->getUser();

    if ($user) {

      if ($this->request->isPost()) {
        $game = Games::findFirst($this->request->getPost('games_id', 'int'));
        
        $report = new Reports([
          'users_id' => $user->id,
          'games_id' => $game->id,
          'report'   => $this->request->getPost('report', 'striptags'),
        ]);

        if (!$report->save()) {
          $this->flashSession->error($report->getMessages());
        } else {
          $this->flashSession->success("Report was created successfully");
          return $this->response->redirect('index');
        }
      }

    } else {
      $this->flashSession->error("Only register user can do this action");      
    }

  }


  public function allAction()
  {
    $numberPage = 1;
    $user = $this->auth->getUser();

    if ($user) {
      $numberPage = $this->request->getQuery("page", "int");
    }

    $phql = 'SELECT g.*';
    $phql .= ' FROM Raffledo\Models\Games AS g';
    $phql .= $user ? '' : ' LIMIT 5';

    $games = $this->modelsManager->executeQuery($phql);

    $paginator = new Paginator([
      "data"  => $games,
      "limit" => 5,
      "page"  => $numberPage
    ]);

    $this->view->page = $paginator->getPaginate();

  }

}

