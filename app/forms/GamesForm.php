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
      'placeholder' => 'URL'
    ]);
    $url->addValidators([
      new PresenceOf([
        'message' => 'The URL is required'
      ]),
      new Url([
        'message' => 'The URL must be a url'
      ])
    ]);
    $this->add($url);


    


    // Company
    $companies = Companies::find();
    $companies_opt = [
      'using' => [
        'id',
        'name'
      ],
      'useEmpty' => false,
      'emptyText' => 'New',
      'emptyValue' => 'new'
    ];
    if (!$options['edit']) {

      $c_name = new Text('c_name', [
        'placeholder' => 'Name'
      ]);
      $c_name->addValidators([
        new PresenceOf([
          'message' => 'The Name is required'
        ])
      ]);
      $this->add($c_name);

      $c_tag = new Text('c_tag', [
        'placeholder' => 'Tag'
      ]);
      $c_tag->addValidators([
        new PresenceOf([
          'message' => 'The Tag is required'
        ])
      ]);
      $this->add($c_tag);

      $c_host = new Text('c_host', [
        'placeholder' => 'Host'
      ]);    
      $c_host->addValidators([
        new PresenceOf([
          'message' => 'The Host is required'
        ]),
        new Url([
          'message' => 'The Host must be a url'
        ])
      ]);
      $this->add($c_host);

      $companies_opt['useEmpty'] = true;
    }

    $this->add(new Select('companies_id', $companies, $companies_opt));




    // Title
    $title = new Text('title', [
      'placeholder' => 'Titel'
    ]);
    $title->addValidators([
      new PresenceOf([
        'message' => 'The Titel is required'
      ])
    ]);
    $this->add($title);
    // Type 4
    $info = new Check('price_info', [
      'value' => 1
    ]);
    $info->setLabel('Info');
    $this->add($info);

    if (isset($entity) && $entity->price_info == 1) {
      $price = new TextArea('price', [
        'placeholder' => 'Preis',
        'rows' => 4,
        'style' => 'resize:none;'
      ]);
    } else {
      $price = new TextArea('price', [
        'placeholder' => 'Preis',
        'rows' => 1,
        'style' => 'resize:none;'
      ]);      
    }
    // Price
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