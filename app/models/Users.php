<?php

namespace Raffledo\Models;

use Phalcon\Validation;
use Phalcon\Validation\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Mvc\Model\Relation;

class Users extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $username;

    /**
     *
     * @var string
     */
    public $password;

    /**
     *
     * @var integer
     */
    public $profiles_id;

    /**
     * Before create the user assign a password
     */
    public function beforeValidationOnCreate()
    {
        if (empty($this->password)) {

            // Generate a plain temporary password
            $tempPassword = preg_replace('/[^a-zA-Z0-9]/', '', base64_encode(openssl_random_pseudo_bytes(12)));

            // Use this password as default
            $this->password = $this->getDI()
                ->getSecurity()
                ->hash($tempPassword);
        }
    }

    /**
     * Validations and business logic
     *
     * @return boolean
     */
    public function validation()
    {
        $validator = new Validation();

        $validator->add('username', new Uniqueness([
            "message" => "The username is already registered"
        ]));

        return $this->validate($validator);
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("phalcon");
        $this->setSource("users");

        $this->belongsTo(
            'profiles_id',
            __NAMESPACE__ . '\Profiles',
            'id',
            [
                'alias' => 'profile',
                'reusable' => true
            ]
        );

        $this->hasMany(
            'id',
            __NAMESPACE__ . '\SavedGames',
            'users_id',
            [
                'alias' => 'savedGames',
                'foreignKey' => [
                    'action' => Relation::ACTION_CASCADE
                ]
            ]
        );

        $this->hasMany(
            'id',
            __NAMESPACE__ . '\HiddenGames',
            'users_id',
            [
                'alias' => 'hiddenGames',
                'foreignKey' => [
                    'action' => Relation::ACTION_CASCADE
                ]
            ]
        );

        $this->hasMany(
            'id',
            __NAMESPACE__ . '\HiddenCompanies',
            'users_id',
            [
                'alias' => 'hiddenCompany',
                'foreignKey' => [
                    'action' => Relation::ACTION_CASCADE
                ]
            ]
        );

        $this->hasMany(
            'id',
            __NAMESPACE__ . '\HiddenTags',
            'users_id',
            [
                'alias' => 'hiddenTags',
                'foreignKey' => [
                    'action' => Relation::ACTION_CASCADE
                ]
            ]
        );

        $this->hasMany(
            'id',
            __NAMESPACE__ . '\SuccessLogins',
            'users_id',
            [
                'alias' => 'successLogins',
                'foreignKey' => [
                    'message' => 'User cannot be deleted because he/she has activity in the system'
                ]
            ]
        );

        $this->hasMany(
            'id',
            __NAMESPACE__ . '\ViewedGames',
            'users_id',
            [
                'alias' => 'viewedGames'
            ]
        );

        $this->hasManyToMany(
            'id',
            __NAMESPACE__ . '\SavedGames',
            'users_id', 'games_id',
            __NAMESPACE__ . '\Games',
            'id',
            [
                'alias' => 'favgames'
            ]
        );
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'users';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Users[]|Users|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Users|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
