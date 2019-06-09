<?php

namespace Raffledo\Models;

use Phalcon\Mvc\Model\Behavior\Timestampable;

class GamesTags extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var integer
     */
    public $games_id;

    /**
     *
     * @var integer
     */
    public $tags_id;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("phalcon");
        $this->setSource("games_tags");

        $this->belongsTo(
            'games_id',
            __NAMESPACE__ . '\Games',
            'id'
        );

        $this->belongsTo(
            'tags_id',
            __NAMESPACE__ . '\Tags',
            'id'
        );
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'games_tags';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return GamesTags[]|GamesTags|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return GamesTags|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
