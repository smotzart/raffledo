<?php
namespace Raffledo\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Element\Check;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Identical;

class LoginForm extends Form
{

  public function initialize($entity = null, $options = null)
  {
    // Username
    $username = new Text('username', [
      'placeholder' => 'Benutzername'
    ]);

    $username->addValidators([
      new PresenceOf([
        'message' => 'Benutzername is ein Pflichtfeld'
      ])
    ]);
    $this->add($username);

    // Password
    $password = new Password('password', [
      'placeholder' => 'Passwort'
    ]);
    $password->addValidators([
      new PresenceOf([
        'message' => 'Passwort ist ein Pflichtfeld'
      ]),
    ]);

    $password->clear();
    $this->add($password);
/*
    // Remember
    $remember = new Check('remember', [
      'value' => 'yes'
    ]);

    $remember->setLabel('Remember me');

    $this->add($remember);*/

    // CSRF
    /*$csrf = new Hidden('csrf');

    $csrf->addValidator(new Identical([
      'value' => $this->security->getSessionToken(),
      'message' => 'CSRF validation failed'
    ]));

    $csrf->clear();

    $this->add($csrf);*/

    // Sign Up
    $this->add(new Submit('Login', [
      'class' => 'btn btn-block btn-lg btn-dark'
    ]));
  }

}
