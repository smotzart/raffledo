<?php

namespace Raffledo\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Check;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Identical;
use Phalcon\Validation\Validator\Url;

class NewGameForm extends Form
{
  public function initialize()
  {
    // Title
    $company = new Text('company', [
      'placeholder' => 'Firma od. Anbieter'
    ]);
    $company->addValidators([
      new PresenceOf([
        'message' => 'The Firma od. Anbieter is required'
      ])
    ]);
    $this->add($company);

    // Description
    $url = new TextArea('url', [
      'placeholder' => 'URL zum Gewinnspiel'
    ]);
    $url->addValidators([
      new PresenceOf([
        'message' => 'The URL zum Gewinnspiel is required'
      ]),
      new Url([
        'message' => 'The URL zum Gewinnspiel must be a url'
      ])
    ]);
    $this->add($url);

    $text1 = new TextArea('text1', [
      'placeholder' => 'Preise: Lösungsvorschlag: Teilnahmeschluss: Sonstiges:',
      'rows' => 4
    ]);
    $this->add($text1);

    $text2 = new TextArea('text2', [
      'placeholder' => 'Gewinnspielanbieter: Ja/Nein Firma: Name: Email:',
      'rows' => 4
    ]);
    $this->add($text2);
  }
}