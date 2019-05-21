<?php

namespace Raffledo\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Element\Check;
use Phalcon\Validation\Validator\PresenceOf;

class CompaniesForm extends Form
{
  public function initialize($entity = null, $options = null)
  {
    // Title
    $name = new Text('name', [
      'placeholder' => 'Name'
    ]);
    $name->addValidators([
      new PresenceOf([
        'message' => 'The name is required'
      ])
    ]);
    $this->add($name);

    // Description
    $host = new TextArea('host', [
      'placeholder' => 'Host'
    ]);
    $host->addValidators([
      new PresenceOf([
        'message' => 'The host is required'
      ])
    ]);
    $this->add($host);

    // Footer
    $footer = new Check('footer', [
      'value' => 1
    ]);
    $footer->setLabel('Show in footer');
    $this->add($footer);
  }
}