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
  public function beforeValidation($data, $entity) 
  {
    $elements = $this->getElements();

    if (isset($data['c_name'])) {
      $elements['c_name']->addValidators([
        new PresenceOf([
          'message' => 'The company Name is required'
        ])
      ]);
    }
    if (isset($data['c_tag'])) {
      $elements['c_tag']->addValidators([
        new PresenceOf([
          'message' => 'The company Tag is required'
        ])
      ]);
    }
    if (isset($data['c_host'])) {
      $elements['c_host']->addValidators([
        new PresenceOf([
          'message' => 'The company Host is required'
        ])
      ]);
    }
  }

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
      $this->add($c_name);

      $c_tag = new Text('c_tag', [
        'placeholder' => 'Tag'
      ]);
      $this->add($c_tag);

      $c_host = new Text('c_host', [
        'placeholder' => 'Host'
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

    $info = new Check('price_info', [
      'value' => 1
    ]);
    $info->setLabel('Info');
    $this->add($info);

    if (isset($entity) && $entity->price_info == 1) {
      $price = new TextArea('price', [
        'placeholder' => 'Information',
        'rows' => 5,
        'style' => 'resize:none;'
      ]);
    } else {
      $price = new TextArea('price', [
        'placeholder' => 'Preis',
        'rows' => 5,
        'style' => 'resize:none;'
      ]);      
    }
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
    $tags_select = new Text('tags_id[]', [
      'placeholder' => 'New tag'
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
    if ($options['deadline_date']) {
      $deadline_date->setDefault($options['deadline_date']);  
    }    
    $this->add($deadline_date);    

    $deadline_time = new Time('deadline_time');
    $deadline_time->setDefault($options['deadline_time']);
    $this->add($deadline_time);

    // Eintrag für
    $enter_dates = $options['enter_dates'];
    $enter_date  = new Select('enter_date', $enter_dates);
    if ($options['enter_date']) {
      $enter_date->setDefault($options['enter_date']);  
    }
    $this->add($enter_date);

    $enter_time = new Time('enter_time');
    $enter_time->setDefault($options['enter_time']);
    $this->add($enter_time);

  }
}