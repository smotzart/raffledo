<?php

namespace Raffledo\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
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

    $google_tag = new TextArea('google_tag', [
      'placeholder' => 'Google code',
      'rows' => 7
    ]);
    $google_tag->addValidators([]);
    $this->add($google_tag);

    $ads_regular = new TextArea('ads_regular', [
      'placeholder' => 'Banner for not registered user',
      'rows' => 7
    ]);
    $ads_regular->addValidators([]);
    $this->add($ads_regular);

    $ads_register = new TextArea('ads_register', [
      'placeholder' => 'Banner for registered user',
      'rows' => 7
    ]);
    $ads_register->addValidators([]);
    $this->add($ads_register);



    $title = new Text('title', [
      'placeholder' => 'Title'
    ]);
    $this->add($title);

    $title_game = new Text('title_game', [
      'placeholder' => 'Title'
    ]);
    $this->add($title_game);

    $title_tag = new Text('title_tag', [
      'placeholder' => 'Title'
    ]);
    $this->add($title_tag);

    $title_company = new Text('title_company', [
      'placeholder' => 'Title'
    ]);
    $this->add($title_company);

    $description = new TextArea('description', [
      'placeholder' => 'Description',
      'rows' => 4
    ]);
    $description->addValidators([]);
    $this->add($description);

    $description_game = new TextArea('description_game', [
      'placeholder' => 'Description',
      'rows' => 4
    ]);
    $description_game->addValidators([]);
    $this->add($description_game);

    $description_tag = new TextArea('description_tag', [
      'placeholder' => 'Description',
      'rows' => 4
    ]);
    $description_tag->addValidators([]);
    $this->add($description_tag);

    $description_company = new TextArea('description_company', [
      'placeholder' => 'Description',
      'rows' => 4
    ]);
    $description_company->addValidators([]);
    $this->add($description_company);

    $this->add(new Submit('Save', [
      'class' => 'btn btn-outline-success'
    ]));

  }
}