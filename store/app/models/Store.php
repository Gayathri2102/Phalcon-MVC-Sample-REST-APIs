<?php

namespace App\Models;

class Store extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $storeid;

    /**
     *
     * @var string
     */
    protected $store_name;

    /**
     *
     * @var double
     */
    protected $store_lat;

    /**
     *
     * @var double
     */
    protected $store_long;

    /**
     * Method to set the value of field storeid
     *
     * @param integer $storeid
     * @return $this
     */
    public function setStoreid($storeid)
    {
        $this->storeid = $storeid;

        return $this;
    }

    /**
     * Method to set the value of field store_name
     *
     * @param string $store_name
     * @return $this
     */
    public function setStoreName($store_name)
    {
        $this->store_name = $store_name;

        return $this;
    }

    /**
     * Method to set the value of field store_lat
     *
     * @param double $store_lat
     * @return $this
     */
    public function setStoreLat($store_lat)
    {
        $this->store_lat = $store_lat;

        return $this;
    }

    /**
     * Method to set the value of field Store_long
     *
     * @param double $store_long
     * @return $this
     */
    public function setStoreLong($store_long)
    {
        $this->store_long = $store_long;

        return $this;
    }

    /**
     * Returns the value of field storeid
     *
     * @return integer
     */
    public function getStoreid()
    {
        return $this->storeid;
    }

    /**
     * Returns the value of field store_name
     *
     * @return string
     */
    public function getStoreName()
    {
        return $this->store_name;
    }

    /**
     * Returns the value of field store_lat
     *
     * @return double
     */
    public function getStoreLat()
    {
        return $this->store_lat;
    }

    /**
     * Returns the value of field store_long
     *
     * @return double
     */
    public function getStoreLong()
    {
        return $this->store_long;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("gayathrib");
        $this->setSource("store");
        $this->hasMany('storeid', 'models\Cart', 'storeid', ['alias' => 'Cart']);
        $this->hasMany('storeid', 'models\ProductByOrder', 'storeid', ['alias' => 'ProductByOrder']);
        $this->hasMany('storeid', 'models\ProductByStore', 'storeid', ['alias' => 'ProductByStore']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'store';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Store[]|Store|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Store|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
