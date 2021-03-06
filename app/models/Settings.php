<?php

namespace Raffledo\Models;

class Settings extends \Phalcon\Mvc\Model
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
    public $entry_amount;

    /**
     *
     * @var string
     */
    public $deadline_time;

    /**
     *
     * @var string
     */
    public $enter_time;

    /**
     *
     * @var string
     */
    public $google_tag;

    /**
     *
     * @var string
     */
    public $ads_regular;

    /**
     *
     * @var string
     */
    public $ads_register;

    /**
     *
     * @var string
     */
    public $title;

    /**
     *
     * @var string
     */
    public $description;

    /**
     *
     * @var string
     */
    public $title_game;

    /**
     *
     * @var string
     */
    public $description_game;

    /**
     *
     * @var string
     */
    public $title_tag;

    /**
     *
     * @var string
     */
    public $description_tag;

    /**
     *
     * @var string
     */
    public $title_company;

    /**
     *
     * @var string
     */
    public $description_company;
    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("raffledo");
        $this->setSource("settings");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'settings';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Settings[]|Settings|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Settings|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
