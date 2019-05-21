<?php
namespace Raffledo\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Element\Check;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Identical;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Confirmation;

class RegisterForm extends Form
{

  public function initialize($entity = null, $options = null)
  {
    $name = new Text('name', [      
      'placeholder' => 'Benutzername'
    ]);

    $name->addValidators([
      new PresenceOf([
        'message' => 'The benutzername is required'
      ])
    ]);
    $this->add($name);

    // Email
    $email = new Text('email', [
      'placeholder' => 'E-Mail'
    ]);

    $email->addValidators([
      new PresenceOf([
        'message' => 'The e-mail is required'
      ]),
      new Email([
        'message' => 'The e-mail is not valid'
      ])
    ]);

    $this->add($email);

    // Password
    $password = new Password('password', [
      'placeholder' => 'Passwort'
    ]);


    $password->addValidators([
      new PresenceOf([
        'message' => 'The Passwort is required'
      ]),
      new StringLength([
        'min' => 6,
        'messageMinimum' => 'Passwort is too short. Minimum 6 characters'
      ]),
      new Confirmation([
        'message' => 'Password doesn\'t match confirmation',
        'with' => 'confirmPassword'
      ])
    ]);

    $this->add($password);

    // Confirm Password
    $confirmPassword = new Password('confirmPassword', [
      'placeholder' => 'Passwort wiederholen'
    ]);

    $confirmPassword->addValidators([
      new PresenceOf([
        'message' => 'The Passwort wiederholen is required'
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
      'message' => 'Terms and conditions must be accepted'
    ]));

    $this->add($terms);

    // CSRF
    $csrf = new Hidden('csrf');

    $csrf->addValidator(new Identical([
      'value' => $this->security->getSessionToken(),
      'message' => 'CSRF validation failed'
    ]));

    $csrf->clear();

    $this->add($csrf);

    // Sign Up
    $this->add(new Submit('Jetzt kostenlos anmelden!', [
      'class' => 'btn btn-block btn-lg btn-dark'
    ]));
  }

}
