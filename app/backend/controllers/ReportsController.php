<?php

namespace Multiple\Backend\Controllers;

use Raffledo\Models\Reports;
use Phalcon\Mvc\Controller;

class ReportsController extends Controller
{

  public function indexAction()
  {
    $this->view->reports = Reports::find();
  }

  public function viewAction($id)
  {
    $report = Reports::findFirstById($id);

    if (!$report) {
      $this->flashSession->error("Entry was not found");
      return $this->dispatcher->forward([
        'action' => 'index'
      ]);
    }

    $this->view->report = $report;
  }

  public function deleteAction($id)
  {
    $report = Reports::findFirstById($id);

    if (!$report) {
      $this->flashSession->error("Entry was not found");
      return $this->dispatcher->forward([
        'action' => 'index'
      ]);
    }

    if (!$report->delete()) {
      $this->flashSession->error($report->getMessages());
    } else {
      $this->flashSession->success("Entry was deleted");
    }

    return $this->dispatcher->forward([
      'action' => 'index'
    ]);
  }

}