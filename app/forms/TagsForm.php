<?php

namespace Raffledo\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Element\Check;
use Phalcon\Validation\Validator\PresenceOf;

class TagsForm extends Form
{
  public function initialize($entity = null, $options = null)
  {
    // Tag
    $tag = new Text('tag', [
      'placeholder' => 'Tag'
    ]);
    $tag->addValidators([
      new PresenceOf([
        'message' => 'The tag is required'
      ])
    ]);
    $this->add($tag);

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
    $description = new TextArea('description', [
      'placeholder' => 'Description'
    ]);
    $this->add($description);

    // Footer
    $footer = new Check('footer', [
      'value' => 1
    ]);
    $footer->setLabel('Show in footer');
    $this->add($footer);

  }
}