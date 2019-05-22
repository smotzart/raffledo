<?php

namespace Raffledo\Models;

class HiddenTags extends \Phalcon\Mvc\Model
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
    public $tags_id;

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
        $this->setSchema("phalcon");
        $this->setSource("hidden_tags");

        $this->belongsTo(
            'tags_id',
            __NAMESPACE__ . '\Tags',
            'id'
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
        return 'hidden_tags';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return HiddenTags[]|HiddenTags|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return HiddenTags|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
