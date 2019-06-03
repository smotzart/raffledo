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
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Confirmation;

class RegisterForm extends Form
{

  public function initialize($entity = null, $options = null)
  {
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
      new StringLength([
        'min' => 6,
        'messageMinimum' => 'Das Passwort ist zu kurz. Es muss mindestens 6 Zeichen lang sein'
      ]),
      new Confirmation([
        'message' => 'Passwort und Wiederholung stimmen nicht überein',
        'with' => 'confirmPassword'
      ])
    ]);

    $this->add($password);

    // Confirm Password
    $confirmPassword = new Password('confirmPassword', [
      'placeholder' => 'Passwort wiederholen ist ein Pflichtfeld'
    ]);

    $confirmPassword->addValidators([
      new PresenceOf([
        'message' => 'Passwortwiederholung ist Pflicht'
      ])
    ]);

    $this->add($confirmPassword);

    // Remember
    $terms = new Check('terms', [
      'value' => 'yes'
    ]);

    $terms->setLabel('Ich habe die Hinweise zum <a href="/datenschutz">Datenschutz</a> gelesen und erkläre mich durch Aktivieren der Checkbox mit der Erhebung, der Verarbeitung sowie der Nutzung meiner persönlichen Kontaktdaten einverstanden.');

    $terms->addValidator(new Identical([
      'value' => 'yes',
      'message' => 'Sie müssen die Teilnahmebedingungen akzeptieren'
    ]));

    $this->add($terms);

    // CSRF
/*    $csrf = new Hidden('csrf');

    $csrf->addValidator(new Identical([
      'value' => $this->security->getSessionToken(),
      'message' => 'CSRF validation failed'
    ]));

    $csrf->clear();

    $this->add($csrf);*/

    // Sign Up
    $this->add(new Submit('Jetzt kostenlos anmelden!', [
      'class' => 'btn btn-block btn-lg btn-dark'
    ]));
  }

}
