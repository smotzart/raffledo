<?php

namespace Raffledo\Models;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Behavior\Timestampable;
use Phalcon\Mvc\Model\Relation;
use Phalcon\Db\Column as Column;


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

    public function afterFetch() {
        foreach ($this->getModelsMetaData()->getDataTypes($this) as $field => $type) {
            if (is_null($this->$field)) {
                continue;
            }
            switch ($type) {
                case Column::TYPE_BOOLEAN:
                    $this->$field = ord($this->$field);
                    break;
                case Column::TYPE_BIGINTEGER:
                case Column::TYPE_INTEGER:
                    $this->$field = intval($this->$field);
                    break;
                case Column::TYPE_DECIMAL:
                case Column::TYPE_FLOAT:
                    $this->$field = floatval($this->$field);
                    break;
                case Column::TYPE_DOUBLE:
                    $this->$field = doubleval($this->$field);
                    break;
            }
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
