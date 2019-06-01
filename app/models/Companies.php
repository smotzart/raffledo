<?php

namespace Raffledo\Models;

use Phalcon\Mvc\Model\Behavior\Timestampable;
use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Mvc\Model\Relation;

class Companies extends Model
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
    public $tag;

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var string
     */
    public $host;

    /**
     *
     * @var integer
     */
    public $footer;

    /**
     *
     * @var string
     */
    public $created_at;

    /**
     *
     * @var string
     */
    public $updated_at;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("phalcon");
        $this->setSource("companies");    
        $this->hasMany(
            'id',
            __NAMESPACE__ . '\Games',
            'companies_id',
            [
                'alias' => 'games',
                'foreignKey' => [
                    'message' => 'Company cannot be deleted because it\'s used on Games'
                ]
            ]
        );  
        $this->hasMany(
            'id',
            __NAMESPACE__ . '\HiddenCompanies',
            'companies_id',
            [
                'alias' => 'hidden',
                'foreignKey' => [
                    'action' => Relation::ACTION_CASCADE
                ]
            ]
        );   
    }
    
    /**
     * Before create the tag 
    */
    public function beforeCreate()
    {
        $this->tag = strtolower(str_replace('+', '-', urlencode($this->tag)));
    }

    /**
     * Before create the tag 
    */
    public function beforeUpdate()
    {
        $this->tag = strtolower(str_replace('+', '-', urlencode($this->tag)));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'companies';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Companies[]|Companies|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Companies|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    /**
     * Validate that emails are unique across users
     */
    public function validation()
    {
        $validator = new Validation();

        $validator->add('tag', new Uniqueness([
            "message" => "The company tag already in use"
        ]));
        $validator->add('name', new Uniqueness([
            "message" => "The company name already in use"
        ]));


        return $this->validate($validator);
    }

}
