<?php

namespace Raffledo\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\Submit;

class UserSettingsForm extends Form
{
  public function initialize($entry = null, $options = null)
  {


    $sort_type = new Select('sort_type',
      [
        '0' => 'Random',
        '1' => 'Einsendeschluss',
      ]
    );
    $sort_type->setDefault($options['sort_type']);
    $this->add($sort_type);

    $notify = new Select('notify',
      [
        '0' => 'Disable',
        '1' => 'Enable',
      ]
    );
    $notify->setDefault($options['notify']);
    $this->add($notify);

    $this->add(new Submit('Save', [
      'class' => 'btn btn-sm btn-outline-success'
    ]));

  }
}