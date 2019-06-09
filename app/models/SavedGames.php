<?php

namespace Raffledo\Models;

class SavedGames extends \Phalcon\Mvc\Model
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
    public $users_id;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("raffledo");
        $this->setSource("saved_games");

        $this->belongsTo(
            'games_id',
            __NAMESPACE__ . '\Games',
            'id',
            [
                'alias' => 'games'
            ]
        );

        $this->belongsTo(
            'users_id',
            __NAMESPACE__ . '\Users',
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
        return 'saved_games';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return SavedGames[]|SavedGames|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return SavedGames|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
