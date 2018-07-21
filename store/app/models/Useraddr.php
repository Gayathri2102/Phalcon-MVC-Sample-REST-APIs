<?php

namespace App\Models;

class Useraddr extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $addressid;

    /**
     *
     * @var string
     */
    protected $addr_line1;

    /**
     *
     * @var string
     */
    protected $addr_line2;

    /**
     *
     * @var string
     */
    protected $city;

    /**
     *
     * @var string
     */
    protected $province;

    /**
     *
     * @var string
     */
    protected $postal_code;

    /**
     *
     * @var integer
     */
    protected $userid;

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
     * Method to set the value of field addr_line1
     *
     * @param string $addr_line1
     * @return $this
     */
    public function setAddrLine1($addr_line1)
    {
        $this->addr_line1 = $addr_line1;

        return $this;
    }

    /**
     * Method to set the value of field addr_line2
     *
     * @param string $addr_line2
     * @return $this
     */
    public function setAddrLine2($addr_line2)
    {
        $this->addr_line2 = $addr_line2;

        return $this;
    }

    /**
     * Method to set the value of field city
     *
     * @param string $city
     * @return $this
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Method to set the value of field province
     *
     * @param string $province
     * @return $this
     */
    public function setProvince($province)
    {
        $this->province = $province;

        return $this;
    }

    /**
     * Method to set the value of field postal_code
     *
     * @param string $postal_code
     * @return $this
     */
    public function setPostalCode($postal_code)
    {
        $this->postal_code = $postal_code;

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
     * Returns the value of field addressid
     *
     * @return integer
     */
    public function getAddressid()
    {
        return $this->addressid;
    }

    /**
     * Returns the value of field addr_line1
     *
     * @return string
     */
    public function getAddrLine1()
    {
        return $this->addr_line1;
    }

    /**
     * Returns the value of field addr_line2
     *
     * @return string
     */
    public function getAddrLine2()
    {
        return $this->addr_line2;
    }

    /**
     * Returns the value of field city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Returns the value of field province
     *
     * @return string
     */
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * Returns the value of field postal_code
     *
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postal_code;
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
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("gayathrib");
        $this->setSource("useraddr");
        $this->hasMany('addressid', 'models\Orders', 'addressid', ['alias' => 'Orders']);
        $this->belongsTo('userid', 'models\User', 'userid', ['alias' => 'User']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'useraddr';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Useraddr[]|Useraddr|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Useraddr|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
