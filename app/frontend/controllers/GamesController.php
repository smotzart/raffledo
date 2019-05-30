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

use Phalcon\Mvc\View;

class GamesController extends ControllerBase
{
  public function initialize()
  {
    $user = $this->auth->getUser();

    if ($user) {
      if ($this->dispatcher->getParam('tag') || $this->dispatcher->getParam('company')) {
        $this->view->setTemplateBefore('tag');  
      } else {
        $this->view->setTemplateBefore('list');
      }  

      $this->view->report  = new ReportForm();
      $this->view->regform = new RegisterForm();

    } else {
      $this->view->setTemplateBefore('default');
    }    
  }


  
  public function indexAction()
  {
    $user = $this->auth->getUser();

    if ($user) {
      if ($this->dispatcher->getParam('tag')) {

      } elseif ($this->dispatcher->getParam('company')) {

      } else {

      }   
    } else {      
      $games = Games::find(['limit' => 5]);
      $this->view->games = $games;

      $this->view->pick('games/default');
    }
    
  }

  public function getAction()
  {
    $this->view->disable();
    $user = $this->auth->getUser();
    $url_path = $this->request->get('path');

    $last = substr($url_path, -5);

    $path = explode('gewinnspiele', $url_path);
    if ($last == 'piele') {
      if (count($path) == 2 && $path[0] == '/') {
        $type = 'index';
      } else {
        $type = 'company';
        $url_tag  = substr($path[0], 1, -1);      
      }
    } elseif ($last == 'spiel') {
      $path = explode('gewinnspiel', $url_path);
      $type = 'tag';
      $url_tag = substr($path[0], 1, -1); 
    } elseif (count($path) > 2) {
      $type = 'all';
    }

    if ($user) {
      $hidden_games_by_tags = 'SELECT g.id as game_hide_by_tag FROM Raffledo\Models\Games AS g LEFT JOIN Raffledo\Models\GamesTags as gt ON gt.games_id = g.id LEFT JOIN Raffledo\Models\HiddenTags as ht on ht.tags_id = gt.tags_id AND ht.users_id = ' . $user->id .' WHERE ht.id IS NOT NULL GROUP BY g.id';
      $hhh = $this->modelsManager->executeQuery($hidden_games_by_tags);
      $not_in = [];
      foreach ($hhh as $hh) {
        $not_in[] = $hh->game_hide_by_tag;
      }
      $not_in = implode(',',$not_in);

      $phql2 = 'SELECT g.*, g.id as g_id';
      $phql2 .= $user ? ' , hg.id as hide_id, sg.id as save_id, vg.id as is_view' : '';
      $phql2 .= ' FROM Raffledo\Models\Games AS g';
      $phql2 .= $user ? ' LEFT JOIN Raffledo\Models\HiddenCompanies AS hc ON hc.companies_id = g.companies_id AND hc.users_id = ' . $user->id : '';
      $phql2 .= $user ? ' LEFT JOIN Raffledo\Models\HiddenGames AS hg ON hg.games_id = g.id AND hg.users_id = ' . $user->id : '';
      $phql2 .= $user ? ' LEFT JOIN Raffledo\Models\SavedGames AS sg ON sg.games_id = g.id AND sg.users_id = ' . $user->id : '';
      $phql2 .= $user ? ' LEFT JOIN Raffledo\Models\ViewedGames AS vg ON vg.games_id = g.id AND vg.users_id = ' . $user->id : '';      
      $phql2 .= $user ? ' WHERE hg.id IS NULL AND hc.id IS NULL AND sg.id IS NOT NULL AND g.enter_date <= CURDATE() AND g.deadline_date > CURDATE()' : ' WHERE g.enter_date <= CURDATE() AND g.deadline_date > CURDATE()';
      $phql2 .= $user && strlen($not_in) > 0 ? ' AND g.id NOT IN ('.$not_in.')' : '';
      $phql2 .= ' ORDER BY g.id DESC';
      $phql2 .= $user ? '' : ' LIMIT 5';

      $favs = $this->modelsManager->executeQuery($phql2);

      $nf = [];
      foreach($favs as $game) {
        $rf = (array)$game;
        $rf['company']['name'] = $game->g->company->name;
        $rf['company']['tag'] = $game->g->company->tag;
        $rf['tags'] = $game->g->tags;
        $nf[] = $rf;
      }
      $result['user'] = $user->id;
      $result['collections']['favorite']['title']  = 'Favoriten';
      $result['collections']['favorite']['games']  = $nf;

    }

    if ($type == 'tag') {
      $tag = Tags::findFirst(['tag = ?0', 'bind' => [$url_tag]]);
      if ($tag) {   
        $phql = 'SELECT g.*, g.id as g_id';
        $phql .= $user ? ' , hg.id as hide_id, sg.id as save_id, vg.id as is_view' : '';
        $phql .= ' FROM Raffledo\Models\Games AS g';
        $phql .= ' LEFT JOIN Raffledo\Models\GamesTags AS gt ON gt.games_id = g.id';
        $phql .= $user ? ' LEFT JOIN Raffledo\Models\HiddenCompanies AS hc ON hc.companies_id = g.companies_id AND hc.users_id = ' . $user->id : '';
        $phql .= $user ? ' LEFT JOIN Raffledo\Models\HiddenGames AS hg ON hg.games_id = g.id AND hg.users_id = ' . $user->id : '';
        $phql .= $user ? ' LEFT JOIN Raffledo\Models\SavedGames AS sg ON sg.games_id = g.id AND sg.users_id = ' . $user->id : '';
        $phql .= $user ? ' LEFT JOIN Raffledo\Models\ViewedGames AS vg ON vg.games_id = g.id AND vg.users_id = ' . $user->id : '';      
        $phql .= $user ? ' WHERE hg.id IS NULL AND hc.id IS NULL AND gt.tags_id = ' . $tag->id . ' AND g.enter_date <= CURDATE() AND g.deadline_date > CURDATE()': ' WHERE gt.tags_id = ' . $tag->id . ' AND g.enter_date <= CURDATE() AND g.deadline_date > CURDATE()';
        $phql .= $user && strlen($not_in) > 0 ? ' AND g.id NOT IN ('.$not_in.')' : '';
        $phql .= ' ORDER BY g.id DESC';
        $phql .= $user ? '' : ' LIMIT 5';

        $games = $this->modelsManager->executeQuery($phql);
        
        $result['search_name'] = $tag->name;
        $result['search_description'] = $tag->description;
      }
    }
    if ($type == 'company') {
      $company = Companies::findFirst(['tag = ?0', 'bind' => [$url_tag]]);
      if ($company) {
        $phql = 'SELECT g.*, g.id as g_id';
        $phql .= $user ? ' , hg.id as hide_id, sg.id as save_id, vg.id as is_view' : '';
        $phql .= ' FROM Raffledo\Models\Games AS g';
        $phql .= $user ? ' LEFT JOIN Raffledo\Models\HiddenCompanies AS hc ON hc.companies_id = g.companies_id AND hc.users_id = ' . $user->id : '';
        $phql .= $user ? ' LEFT JOIN Raffledo\Models\HiddenGames AS hg ON hg.games_id = g.id AND hg.users_id = ' . $user->id : '';
        $phql .= $user ? ' LEFT JOIN Raffledo\Models\SavedGames AS sg ON sg.games_id = g.id AND sg.users_id = ' . $user->id : '';
        $phql .= $user ? ' LEFT JOIN Raffledo\Models\ViewedGames AS vg ON vg.games_id = g.id AND vg.users_id = ' . $user->id : '';      
        $phql .= $user ? ' WHERE hg.id IS NULL AND hc.id IS NULL AND  g.companies_id = ' . $company->id . ' AND g.enter_date <= CURDATE() AND g.deadline_date > CURDATE()': ' WHERE g.companies_id = ' . $company->id . ' AND g.enter_date <= CURDATE() AND g.deadline_date > CURDATE()';
        $phql .= $user && strlen($not_in) > 0 ? ' AND g.id NOT IN ('.$not_in.')' : '';
        $phql .= ' ORDER BY g.id DESC';
        $phql .= $user ? '' : ' LIMIT 5';

        $games = $this->modelsManager->executeQuery($phql);

        $result['search_name'] = $company->name;
      }
    }
    if ($type == 'all') {            
      $phql = 'SELECT g.*, g.id as g_id';
      $phql .= ' FROM Raffledo\Models\Games AS g';
      $phql .= ' WHERE g.enter_date <= CURDATE() AND g.deadline_date > CURDATE()';
      $phql .= $user ? '' : ' LIMIT 5';

      $games = $this->modelsManager->executeQuery($phql);
    }
    if ($type == 'index') { 
      $phql = 'SELECT g.*, g.id as g_id';
      $phql .= $user ? ' , hg.id as hide_id, sg.id as save_id, vg.id as is_view' : '';
      $phql .= ' FROM Raffledo\Models\Games AS g';
      $phql .= $user ? ' LEFT JOIN Raffledo\Models\HiddenCompanies AS hc ON hc.companies_id = g.companies_id AND hc.users_id = ' . $user->id : '';
      $phql .= $user ? ' LEFT JOIN Raffledo\Models\HiddenGames AS hg ON hg.games_id = g.id AND hg.users_id = ' . $user->id : '';
      $phql .= $user ? ' LEFT JOIN Raffledo\Models\SavedGames AS sg ON sg.games_id = g.id AND sg.users_id = ' . $user->id : '';
      $phql .= $user ? ' LEFT JOIN Raffledo\Models\ViewedGames AS vg ON vg.games_id = g.id AND vg.users_id = ' . $user->id : '';      
      $phql .= $user ? ' WHERE hg.id IS NULL AND hc.id IS NULL AND sg.id IS NULL AND g.enter_date <= CURDATE() AND g.deadline_date > CURDATE()' : ' WHERE g.enter_date <= CURDATE() AND g.deadline_date > CURDATE()';
      $phql .= $user && strlen($not_in) > 0 ? ' AND g.id NOT IN ('.$not_in.')' : '';
      $phql .= ' ORDER BY g.id DESC';
      $phql .= $user ? '' : ' LIMIT 5';

      $games = $this->modelsManager->executeQuery($phql);
    }

    $display_games = [];
    foreach($games as $game) {
      $rg = (array)$game;
      $rg['company']['name'] = $game->g->company->name;
      $rg['company']['tag'] = $game->g->company->tag;
      $rg['tags'] = $game->g->tags;
      $display_games[] = $rg;
    }

    $result['collections']['regular']['title'] = 'Aktuelle Gewinnspiele';
    $result['collections']['regular']['games'] = $display_games;   
      

    echo json_encode($result);   
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
    $response = new \Phalcon\Http\Response();
    $this->view->disable();
    $user = $this->auth->getUser();

    if ($user) {
      if ($this->request->isPost()) {
        $game = Games::findFirst($this->request->getPut('actionId', 'int'));
        $type = $this->request->getPut('actionType', 'striptags');

        if ($type == 'save') {
          $proc_game = SavedGames::findFirst(['games_id = ' . $game->id . ' AND users_id = ' . $user->id]);
          if ($proc_game) {
            $proc_game->delete();
            $response->setStatusCode(200, "OK");
          } else {
            $new = new SavedGames(['games_id' => $game->id, 'users_id' => $user->id]);
            if (!$new->save()) {
              $response->setStatusCode(404, "Can't save");
            } else {
              $response->setStatusCode(200, "OK");
            }
          }       
          return $response->send();
        }



        if ($type == 'hide') {
          $proc_game = HiddenGames::findFirst(['games_id = ' . $game->id . ' AND users_id = ' . $user->id]);
          if ($proc_game) {
            $proc_game->delete();
            $response->setStatusCode(200, "OK");
          } else {
            $new = new HiddenGames(['games_id' => $game->id, 'users_id' => $user->id]);
            if (!$new->save()) {              
              $response->setStatusCode(404, "Can't hide");
            } else {
              $response->setStatusCode(200, "OK");
            }
          }       
          return $response->send();
        } 

        if ($type == 'hideCompany') {
          $entry = HiddenCompanies::findFirst(['companies_id = ' . $game->companies_id . ' AND users_id = ' . $user->id]);
          if ($entry) {
            $response->setStatusCode(404, "Campany allready hidden");
          } else {
            $new = new HiddenCompanies(['companies_id' => $game->companies_id, 'users_id' => $user->id]);
            if (!$new->save()) {              
              $response->setStatusCode(404, "Can't hide company");
            } else {
              $response->setStatusCode(200, "OK");              
            }
          }
          return $response->send();
        } 

        if ($type == 'hideTags') {
          $proc_tags = $this->request->getPut('tags_id');
          if (!is_array($proc_tags)) {
            $proc_tags = explode(",", $proc_tags);
          }


          foreach ($proc_tags as $proc_tag) {
            $entry = HiddenTags::findFirst(['tags_id = ' . $proc_tag . ' AND users_id = ' . $user->id]);
            if ($entry) {
              $this->flashSession->error("Tag ".$entry->tag_entry->name." is allredy hidden for you");
            } else {
              $new = new HiddenTags(['tags_id' => $proc_tag, 'users_id' => $user->id]);
              if (!$new->save()) {              
                $this->flashSession->error("Can't hide tag");
              } else {                
                $response->setStatusCode(200, "OK");   
                //$this->flashSession->success("Tag ".$entry->tag_entry->name." successfully hide for you");
              }
            }
          }  
          return $response->send();        
        } 
        
        return $this->response->redirect('/gewinnspiele');        
      }

    } else {
      $response->setStatusCode(404, "Only register user can do this action");
    }

    

    return $response->send();
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

}

