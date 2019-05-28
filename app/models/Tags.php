<?php

namespace Raffledo\Models;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Behavior\Timestampable;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Mvc\Model\Relation;

class Tags extends Model
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
    public $description;

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
        $this->setSource("tags");
        $this->hasMany(
            'id',
            __NAMESPACE__ . '\GamesTags',
            'tags_id',
            [
                'foreignKey' => [
                    'action' => Relation::ACTION_CASCADE
                ]
            ]
        );
        $this->hasMany(
            'id',
            __NAMESPACE__ . '\HiddenTags',
            'tags_id',
            [
                'foreignKey' => [
                    'action' => Relation::ACTION_CASCADE
                ]
            ]
        ); 

        $this->hasManyToMany(
            'id',
            __NAMESPACE__ . '\GamesTags',
            'tags_id', 'games_id',
            __NAMESPACE__ . '\Games',
            'id',
            [
                'alias' => 'games'
            ]
        );

        $this->addBehavior(
            new Timestampable(
                [
                    'beforeCreate' => [
                        'field'  => 'created_at',
                        'format' => 'Y-m-d H:i:s',
                    ]
                ]
            )
        );
        $this->addBehavior(
            new Timestampable(
                [
                    'beforeUpdate' => [
                        'field'  => 'updated_at',
                        'format' => 'Y-m-d H:i:s',
                    ]
                ]
            )
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
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'tags';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Tags[]|Tags|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Tags|\Phalcon\Mvc\Model\ResultInterface
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
            "message" => "The tag is already isset"
        ]));

        return $this->validate($validator);
    }
}
