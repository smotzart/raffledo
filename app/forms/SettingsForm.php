<?php

namespace Raffledo\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Date;
use Phalcon\Forms\Element\Submit;
use Phalcon\Validation\Validator\PresenceOf;

class Time extends Date
{
  public function render($attributes = null)
  {
    $html = \Phalcon\Tag::timeField($this->prepareAttributes($attributes));
    return $html;
  }
}

class SettingsForm extends Form
{
  public function initialize($entity = null)
  {
    $entry_amount = new Text('entry_amount', [
      'placeholder' => 'Amount per day'
    ]);
    $entry_amount->addValidators([
      new PresenceOf([
        'message' => 'The amount is required'
      ])
    ]);
    $entry_amount->setDefault(10);
    $this->add($entry_amount);

    $deadline_time = new Time('deadline_time');
    $deadline_time->setDefault('23:59');
    $this->add($deadline_time);

    $enter_time = new Time('enter_time');
    $enter_time->setDefault('23:59');
    $this->add($enter_time);

    $this->add(new Submit('Save', [
      'class' => 'btn btn-outline-success'
    ]));

  }
}