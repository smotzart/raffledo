<?php

namespace Raffledo\Models;

class Sorting extends \Phalcon\Mvc\Model
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
    public $sorting_ids;

    /**
     *
     * @var string
     */
    public $date;

    /**
     * Before create
    */
    public function beforeValidationOnCreate()
    {
        $this->date = date('Y-m-d');
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("raffledo");
        $this->setSource("sorting");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'sorting';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Sorting[]|Sorting|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Sorting|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
