<?php

namespace App\Models;

class ProductByOrder extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $orderid;

    /**
     *
     * @var integer
     */
    protected $prodid;

    /**
     *
     * @var integer
     */
    protected $storeid;

    /**
     *
     * @var double
     */
    protected $price;

    /**
     *
     * @var integer
     */
    protected $quantity;

    /**
     * Method to set the value of field orderid
     *
     * @param integer $orderid
     * @return $this
     */
    public function setOrderid($orderid)
    {
        $this->orderid = $orderid;

        return $this;
    }

    /**
     * Method to set the value of field prodid
     *
     * @param integer $prodid
     * @return $this
     */
    public function setProdid($prodid)
    {
        $this->prodid = $prodid;

        return $this;
    }

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
     * Method to set the value of field price
     *
     * @param double $price
     * @return $this
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Method to set the value of field quantity
     *
     * @param integer $quantity
     * @return $this
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Returns the value of field orderid
     *
     * @return integer
     */
    public function getOrderid()
    {
        return $this->orderid;
    }

    /**
     * Returns the value of field prodid
     *
     * @return integer
     */
    public function getProdid()
    {
        return $this->prodid;
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
     * Returns the value of field price
     *
     * @return double
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Returns the value of field quantity
     *
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("gayathrib");
        $this->setSource("product_by_order");
        $this->belongsTo('orderid', 'models\Orders', 'orderid', ['alias' => 'Orders']);
        $this->belongsTo('prodid', 'models\Product', 'prodid', ['alias' => 'Product']);
        $this->belongsTo('storeid', 'models\Store', 'storeid', ['alias' => 'Store']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'product_by_order';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ProductByOrder[]|ProductByOrder|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ProductByOrder|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
