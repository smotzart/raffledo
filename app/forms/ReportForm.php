<?php

namespace Raffledo\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Validation\Validator\PresenceOf;

class ReportForm extends Form
{
  public function initialize()
  {
    $report = new TextArea('report', [
      'placeholder' => 'Nachricht',
      'rows' => 4,
      'required' => 'required'
    ]);
    $report->addValidators([
      new PresenceOf([
        'message' => 'The Nachricht is required'
      ])
    ]);
    $this->add($report);
  }
}