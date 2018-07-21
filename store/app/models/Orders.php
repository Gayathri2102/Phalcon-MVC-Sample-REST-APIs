<?php

namespace App\Models;

class Orders extends \Phalcon\Mvc\Model
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
    protected $userid;

    /**
     *
     * @var integer
     */
    protected $addressid;

    /**
     *
     * @var integer
     */
    protected $cartid;

    /**
     *
     * @var double
     */
    protected $orderprice;

    /**
     *
     * @var string
     */
    protected $order_status;

    /**
     *
     * @var string
     */
    protected $order_date;

    /**
     *
     * @var integer
     */
    protected $cardid;

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
     * Method to set the value of field userid
     *
     * @param integer $userid
     * @return $this
     */
    public function setUserid($userid)
    {
        $this->userid = $userid;

        return $this;
    }

    /**
     * Method to set the value of field addressid
     *
     * @param integer $addressid
     * @return $this
     */
    public function setAddressid($addressid)
    {
        $this->addressid = $addressid;

        return $this;
    }

    /**
     * Method to set the value of field cartid
     *
     * @param integer $cartid
     * @return $this
     */
    public function setCartid($cartid)
    {
        $this->cartid = $cartid;

        return $this;
    }

    /**
     * Method to set the value of field orderprice
     *
     * @param double $orderprice
     * @return $this
     */
    public function setOrderprice($orderprice)
    {
        $this->orderprice = $orderprice;

        return $this;
    }

    /**
     * Method to set the value of field order_status
     *
     * @param string $order_status
     * @return $this
     */
    public function setOrderStatus($order_status)
    {
        $this->order_status = $order_status;

        return $this;
    }

    /**
     * Method to set the value of field order_date
     *
     * @param string $order_date
     * @return $this
     */
    public function setOrderDate($order_date)
    {
        $this->order_date = $order_date;

        return $this;
    }

    /**
     * Method to set the value of field cardid
     *
     * @param integer $cardid
     * @return $this
     */
    public function setCardid($cardid)
    {
        $this->cardid = $cardid;

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
     * Returns the value of field userid
     *
     * @return integer
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * Returns the value of field addressid
     *
     * @return integer
     */
    public function getAddressid()
    {
        return $this->addressid;
    }

    /**
     * Returns the value of field cartid
     *
     * @return integer
     */
    public function getCartid()
    {
        return $this->cartid;
    }

    /**
     * Returns the value of field orderprice
     *
     * @return double
     */
    public function getOrderprice()
    {
        return $this->orderprice;
    }

    /**
     * Returns the value of field order_status
     *
     * @return string
     */
    public function getOrderStatus()
    {
        return $this->order_status;
    }

    /**
     * Returns the value of field order_date
     *
     * @return string
     */
    public function getOrderDate()
    {
        return $this->order_date;
    }


    /**
     * Returns the value of field cardid
     *
     * @return integer
     */
    public function getCardid()
    {
        return $this->cardid;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("gayathrib");
        $this->setSource("orders");
        $this->hasMany('orderid', 'models\ProductByOrder', 'orderid', ['alias' => 'ProductByOrder']);
        $this->belongsTo('userid', 'models\User', 'userid', ['alias' => 'User']);
        $this->belongsTo('addressid', 'models\Useraddr', 'addressid', ['alias' => 'Useraddr']);
        $this->belongsTo('cartid', 'models\Cart', 'cartid', ['alias' => 'Cart']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'orders';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Orders[]|Orders|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Orders|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
