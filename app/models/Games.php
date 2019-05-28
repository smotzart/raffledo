<?php

namespace Raffledo\Models;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Behavior\Timestampable;
use Phalcon\Mvc\Model\Relation;


class Games extends Model
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
    public $url;

    /**
     *
     * @var integer
     */
    public $companies_id;

    /**
     *
     * @var string
     */
    public $title;

    /**
     *
     * @var string
     */
    public $price;

    /**
     *
     * @var integer
     */
    public $price_info;

    /**
     *
     * @var integer
     */
    public $type_register;

    /**
     *
     * @var integer
     */
    public $type_sms;

    /**
     *
     * @var integer
     */
    public $type_buy;

    /**
     *
     * @var integer
     */
    public $type_internet;

    /**
     *
     * @var integer
     */
    public $type_submission;

    /**
     *
     * @var string
     */
    public $suggested_solution;

    /**
     *
     * @var string
     */
    public $deadline_date;

    /**
     *
     * @var string
     */
    public $deadline_time;

    /**
     *
     * @var string
     */
    public $enter_date;

    /**
     *
     * @var string
     */
    public $enter_time;

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
     * Before create the user assign a password
     */
    public function beforeValidationOnCreate()
    {
        // Timestamp the confirmation
        $this->created_at = time();
    }

    /**
     * Sets the timestamp before update the confirmation
     */
    public function beforeValidationOnUpdate()
    {
        // Timestamp the confirmation
        $this->updated_at = time();
    }
    
    /**
     * Before create the game assign a password
     */
    public function beforeCreate()
    {
        if (!$this->deadline_date) {
            $this->deadline_date = time();    
        }
        if (!$this->enter_date) {
            $this->enter_date = time();
        }
    }

    /**
     * Sets the timestamp before update the confirmation
     */
    public function beforeUpdate()
    {       
        if (!$this->deadline_date) {
            $this->deadline_date = time();    
        }
        if (!$this->enter_date) {
            $this->enter_date = time();
        } 
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("phalcon");
        $this->setSource("games");

        $this->belongsTo(
            'companies_id',
            __NAMESPACE__ . '\Companies',
            'id',
            [
                'alias' => 'company'
            ]
        );
        $this->hasMany(
            'id',
            __NAMESPACE__ . '\GamesTags',
            'games_id',
            [
                'foreignKey' => [
                    'action' => Relation::ACTION_CASCADE
                ],
                'alias' => 'gamesTags'
            ]
        );    
        $this->hasMany(
            'id',
            __NAMESPACE__ . '\HiddenGames',
            'games_id',
            [
                'foreignKey' => [
                    'action' => Relation::ACTION_CASCADE
                ]
            ]
        );  
        $this->hasMany(
            'id',
            __NAMESPACE__ . '\SavedGames',
            'games_id',
            [
                'foreignKey' => [
                    'action' => Relation::ACTION_CASCADE
                ]
            ]
        );  
        $this->hasMany(
            'id',
            __NAMESPACE__ . '\ViewedGames',
            'games_id',
            [
                'foreignKey' => [
                    'action' => Relation::ACTION_CASCADE
                ]
            ]
        );   
        $this->hasManyToMany(
            'id',
            __NAMESPACE__ . '\GamesTags',
            'games_id', 'tags_id',
            __NAMESPACE__ . '\Tags',
            'id',
            [
                'alias' => 'tags'
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
        return 'games';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Games[]|Games|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Games|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
