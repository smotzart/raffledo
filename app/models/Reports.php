<?php

namespace Raffledo\Models;

class Reports extends \Phalcon\Mvc\Model
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
    public $users_id;

    /**
     *
     * @var integer
     */
    public $games_id;

    /**
     *
     * @var string
     */
    public $report;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("raffledo");
        $this->setSource("reports");
        $this->belongsTo(
            'games_id',
            __NAMESPACE__ . '\Games',
            'id',
            [
                'alias' => 'game'
            ]
        );
        $this->belongsTo(
            'users_id',
            __NAMESPACE__ . '\Users',
            'id',
            [
                'alias' => 'user'
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
        return 'reports';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Reports[]|Reports|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Reports|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
