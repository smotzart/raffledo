<?php

namespace Raffledo\Models;

class HiddenCompanies extends \Phalcon\Mvc\Model
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
    public $companies_id;

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
        $this->setSource("hidden_companies");

        $this->belongsTo(
            'companies_id',
            __NAMESPACE__ . '\Companies',
            'id',
            [
                'alias' => 'company'
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
        return 'hidden_companies';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return HiddenCompanies[]|HiddenCompanies|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return HiddenCompanies|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
