<?php

namespace Multiple\Frontend\Controllers;

use Raffledo\Forms\GamesForm;
use Raffledo\Models\Games;
use Raffledo\Models\Tags;
use Raffledo\Models\SavedGames;
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
      $search_name = $tag->name;
      $this->view->search_description = $tag->description;
    } elseif ($this->dispatcher->getParam('company')) {
      $search_name = Companies::findFirst(['tag = ?0', 'bind' => [$this->dispatcher->getParam('company')]])->name;
    } else {
      $search_name = '';
    }
    $this->view->search_name = $search_name;

  }

  public function indexAction()
  {
    if ($this->dispatcher->getParam('tag')) {
      $games = Tags::findFirst(['tag = ?0', 'bind' => [$this->dispatcher->getParam('tag')]])->games;
    } elseif ($this->dispatcher->getParam('company')) {
      $games = Companies::findFirst(['tag = ?0', 'bind' => [$this->dispatcher->getParam('company')]])->games;
    } else {
      $games = Games::find();
    }
    
    $numberPage = 1;
    if (is_array($this->auth->getIdentity())) {
      $numberPage = $this->request->getQuery("page", "int");
    }

    $paginator = new Paginator([
      "data"  => $games,
      "limit" => 5,
      "page"  => $numberPage
    ]);

    $this->view->page = $paginator->getPaginate();

  }

  public function searchAction()
  {
    $numberPage = 1;
    if ($this->request->isPost()) {
      $query = Criteria::fromInput($this->di, 'Raffledo\Models\Games', $this->request->getPost());
      $this->persistent->searchParams = $query->getParams();
    } elseif (is_array($this->auth->getIdentity())) {
      $numberPage = $this->request->getQuery("page", "int");
    }

    $parameters = [];
    if ($this->persistent->searchParams) {
      $parameters = $this->persistent->searchParams;
    }

    $games = Games::find($parameters);
    if (count($games) == 0) {
      $this->flash->notice("The search did not find any games");
      return $this->dispatcher->forward([
        "action" => "index"
      ]);
    }

    $paginator = new Paginator([
      "data" => $games,
      "limit" => 2,
      "page" => $numberPage
    ]);

    $this->view->numberPage = $numberPage;
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

    $games = SavedGames::findByUsersId($this->auth->getUser()->id);

    $numberPage = 1;
    if (is_array($this->auth->getIdentity())) {
      $numberPage = $this->request->getQuery("page", "int");
    }

    $paginator = new Paginator([
      "data"  => $games,
      "limit" => 5,
      "page"  => $numberPage
    ]);

    $this->view->page = $paginator->getPaginate();

  }

}

