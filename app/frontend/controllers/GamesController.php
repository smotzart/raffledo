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

class GamesController extends ControllerBase
{

  public function initialize()
  {
    $this->view->setTemplateBefore('list');
    $this->view->logged_in = is_array($this->auth->getIdentity()); 

    $this->view->report  = new ReportForm();
    $this->view->regform = new RegisterForm();
  }

  public function indexAction()
  {
    $user = $this->auth->getUser();

    if ($user) {
      $this->view->register_view = true;

      $hidden_games_by_tags = 'SELECT g.id as game_hide_by_tag FROM Raffledo\Models\Games AS g LEFT JOIN Raffledo\Models\GamesTags as gt ON gt.games_id = g.id LEFT JOIN Raffledo\Models\HiddenTags as ht on ht.tags_id = gt.tags_id AND ht.users_id = ' . $user->id .' WHERE ht.id IS NOT NULL GROUP BY g.id';
      $hhh = $this->modelsManager->executeQuery($hidden_games_by_tags);
      $not_in = [];
      foreach ($hhh as $hh) {
        $not_in[] = $hh->game_hide_by_tag;
      }
      $not_in = implode(',',$not_in);
    }
    

    if ($this->dispatcher->getParam('tag')) {

      $tag = Tags::findFirst(['tag = ?0', 'bind' => [$this->dispatcher->getParam('tag')]]);
      if (!$tag) {
        return $this->flashSession->error("Can't find choosen tag");
      }

      $phql = 'SELECT g.*';
      $phql .= $user ? ' , hg.id as hide_id, hg.users_id as hide_user, sg.id as save_id, sg.users_id as save_user, vg.id as is_view' : '';
      $phql .= ' FROM Raffledo\Models\Games AS g';
      $phql .= ' LEFT JOIN Raffledo\Models\GamesTags AS gt ON gt.games_id = g.id';
      $phql .= $user ? ' LEFT JOIN Raffledo\Models\HiddenCompanies AS hc ON hc.companies_id = g.companies_id AND hc.users_id = ' . $user->id : '';
      $phql .= $user ? ' LEFT JOIN Raffledo\Models\HiddenGames AS hg ON hg.games_id = g.id AND hg.users_id = ' . $user->id : '';
      $phql .= $user ? ' LEFT JOIN Raffledo\Models\SavedGames AS sg ON sg.games_id = g.id AND sg.users_id = ' . $user->id : '';
      $phql .= $user ? ' LEFT JOIN Raffledo\Models\ViewedGames AS vg ON vg.games_id = g.id AND vg.users_id = ' . $user->id : '';      
      $phql .= $user ? ' WHERE hg.id IS NULL AND hc.id IS NULL AND gt.tags_id = ' . $tag->id : ' WHERE gt.tags_id = ' . $tag->id;
      $phql .= $user && strlen($not_in) > 0 ? ' AND g.id NOT IN ('.$not_in.')' : '';
      $phql .= ' ORDER BY g.id DESC';
      $phql .= $user ? '' : ' LIMIT 5';

      $games = $this->modelsManager->executeQuery($phql);
      
      $this->view->search_name = $tag->name;
      $this->view->search_description = $tag->description;
      $this->view->limited_view = true;

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
      $phql .= $user ? ' WHERE hg.id IS NULL AND hc.id IS NULL AND g.companies_id = ' . $company->id : ' WHERE g.companies_id = ' . $company->id;
      $phql .= $user && strlen($not_in) > 0 ? ' AND g.id NOT IN ('.$not_in.')' : '';
      $phql .= ' ORDER BY g.id DESC';
      $phql .= $user ? '' : ' LIMIT 5';

      $games = $this->modelsManager->executeQuery($phql);

      $this->view->search_name = $company->name;
      $this->view->limited_view = true;

    } else {

      $phql = 'SELECT g.*';
      $phql .= $user ? ' , hg.id as hide_id, hg.users_id as hide_user, sg.id as save_id, sg.users_id as save_user, vg.id as is_view' : '';
      $phql .= ' FROM Raffledo\Models\Games AS g';
      $phql .= $user ? ' LEFT JOIN Raffledo\Models\HiddenCompanies AS hc ON hc.companies_id = g.companies_id AND hc.users_id = ' . $user->id : '';
      $phql .= $user ? ' LEFT JOIN Raffledo\Models\HiddenGames AS hg ON hg.games_id = g.id AND hg.users_id = ' . $user->id : '';
      $phql .= $user ? ' LEFT JOIN Raffledo\Models\SavedGames AS sg ON sg.games_id = g.id AND sg.users_id = ' . $user->id : '';
      $phql .= $user ? ' LEFT JOIN Raffledo\Models\ViewedGames AS vg ON vg.games_id = g.id AND vg.users_id = ' . $user->id : '';      
      $phql .= $user ? ' WHERE hg.id IS NULL AND hc.id IS NULL AND sg.id IS NULL' : '';
      $phql .= $user && strlen($not_in) > 0 ? ' AND g.id NOT IN ('.$not_in.')' : '';
      $phql .= ' ORDER BY g.id DESC';
      $phql .= $user ? '' : ' LIMIT 5';

      $games = $this->modelsManager->executeQuery($phql);

      $phql2 = 'SELECT g.*';
      $phql2 .= $user ? ' , hg.id as hide_id, hg.users_id as hide_user, sg.id as save_id, sg.users_id as save_user, vg.id as is_view' : '';
      $phql2 .= ' FROM Raffledo\Models\Games AS g';
      $phql2 .= $user ? ' LEFT JOIN Raffledo\Models\HiddenCompanies AS hc ON hc.companies_id = g.companies_id AND hc.users_id = ' . $user->id : '';
      $phql2 .= $user ? ' LEFT JOIN Raffledo\Models\HiddenGames AS hg ON hg.games_id = g.id AND hg.users_id = ' . $user->id : '';
      $phql2 .= $user ? ' LEFT JOIN Raffledo\Models\SavedGames AS sg ON sg.games_id = g.id AND sg.users_id = ' . $user->id : '';
      $phql2 .= $user ? ' LEFT JOIN Raffledo\Models\ViewedGames AS vg ON vg.games_id = g.id AND vg.users_id = ' . $user->id : '';      
      $phql2 .= $user ? ' WHERE hg.id IS NULL AND hc.id IS NULL AND sg.id IS NOT NULL' : '';
      $phql2 .= $user && strlen($not_in) > 0 ? ' AND g.id NOT IN ('.$not_in.')' : '';
      $phql2 .= ' ORDER BY g.id DESC';
      $phql2 .= $user ? '' : ' LIMIT 5';

      $favs = $this->modelsManager->executeQuery($phql2);

      $this->view->favs = $favs;

    }

    $this->view->games = $games;
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
          return true;
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
          return true;   
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
    $user = $this->auth->getUser();

    $phql = 'SELECT g.*';
    $phql .= ' FROM Raffledo\Models\Games AS g';
    $phql .= $user ? '' : ' LIMIT 5';

    $games = $this->modelsManager->executeQuery($phql);

    $this->view->games = $games;
  }

}

