<?php

namespace Raffledo\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Date;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\Check;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Url;
use Raffledo\Models\Companies;
use Raffledo\Models\Tags;


class Time extends Date
{
  public function render($attributes = null)
  {
    $html = \Phalcon\Tag::timeField($this->prepareAttributes($attributes));
    return $html;
  }
}

class GamesForm extends Form
{
  public function initialize($entity = null, $options = null)
  {
    // Url
    $url = new Text('url', [
      'placeholder' => 'Url'
    ]);
    $url->addValidators([
      new PresenceOf([
        'message' => 'The url is required'
      ]),
      new Url([
        'message' => 'The url must be a url'
      ])
    ]);
    $this->add($url);

    // Company
    $companies = Companies::find();
    $this->add(new Select('companies_id', $companies, [
      'using' => [
        'id',
        'name'
      ],
      'useEmpty' => false
    ]));

    // Title
    $title = new Text('title', [
      'placeholder' => 'Title'
    ]);
    $title->addValidators([
      new PresenceOf([
        'message' => 'The title is required'
      ])
    ]);
    $this->add($title);

    // Price
    $price = new TextArea('price', [
      'placeholder' => 'Price'
    ]);
    $this->add($price);

    // Type 1
    $type_1 = new Check('type_register', [
      'value' => 1
    ]);
    $type_1->setLabel('Registrierung vor Teilnahme erforderlich');
    $this->add($type_1);

    // Type 2
    $type_2 = new Check('type_sms', [
      'value' => 1
    ]);
    $type_2->setLabel('SMS/Anruf erforderlich');
    $this->add($type_2);

    // Type 3
    $type_3 = new Check('type_buy', [
      'value' => 1
    ]);
    $type_3->setLabel('Produktkauf erforderlich');
    $this->add($type_3);

    // Type 4
    $type_4 = new Check('type_internet', [
      'value' => 1
    ]);
    $type_4->setLabel('Online-Spiel');
    $this->add($type_4);

    // Type 5
    $type_5 = new Check('type_submission', [
      'value' => 1
    ]);
    $type_5->setLabel('Kreativ-Einsendung erforderlich');
    $this->add($type_5);
 
    // Tags
    $tags = Tags::find();
    $tags_select = new Select('tags_id[]', $tags, [
      'using' => [
        'id',
        'name'
      ],
      'useEmpty' => false,
      'multiple' => true,
      'size' => 10
    ]);
    $tags_select->setDefault($options['tags']);
    $this->add($tags_select);

    // Lösungsvorschlag
    $suggested_solution = new Text('suggested_solution', [
      'placeholder' => 'Lösungsvorschlag'
    ]);
    $this->add($suggested_solution);

    // Einsendeschluss
    $deadline_date = new Date('deadline_date', [
      'placeholder' => 'Einsendeschluss'
    ]);
    $this->add($deadline_date);

    $deadline_time = new Time('deadline_time');
    $deadline_time->setDefault('23:59');
    $this->add($deadline_time);

    // Eintrag für
    $enter_date = new Date('enter_date', [
      'placeholder' => 'Eintrag für'
    ]);
    $this->add($enter_date);

    $enter_time = new Time('enter_time');
    $enter_time->setDefault('23:59');
    $this->add($enter_time);

  }
}