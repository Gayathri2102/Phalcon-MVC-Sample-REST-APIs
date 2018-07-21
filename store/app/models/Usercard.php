<?php

namespace App\Models;

class Usercard extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $cardid;

    /**
     *
     * @var integer
     */
    protected $cardno;

    /**
     *
     * @var string
     */
    protected $expiry_dt;

    /**
     *
     * @var integer
     */
    protected $cvv;

    /**
     *
     * @var string
     */
    protected $cardtype;

    /**
     *
     * @var integer
     */
    protected $userid;

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
     * Method to set the value of field cardno
     *
     * @param integer $cardno
     * @return $this
     */
    public function setCardno($cardno)
    {
        $this->cardno = $cardno;

        return $this;
    }

    /**
     * Method to set the value of field expiry_dt
     *
     * @param string $expiry_dt
     * @return $this
     */
    public function setExpiryDt($expiry_dt)
    {
        $this->expiry_dt = $expiry_dt;

        return $this;
    }

    /**
     * Method to set the value of field cvv
     *
     * @param integer $cvv
     * @return $this
     */
    public function setCvv($cvv)
    {
        $this->cvv = $cvv;

        return $this;
    }

    /**
     * Method to set the value of field cardtype
     *
     * @param string $cardtype
     * @return $this
     */
    public function setCardtype($cardtype)
    {
        $this->cardtype = $cardtype;

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
     * Returns the value of field cardid
     *
     * @return integer
     */
    public function getCardid()
    {
        return $this->cardid;
    }

    /**
     * Returns the value of field cardno
     *
     * @return integer
     */
    public function getCardno()
    {
        return $this->cardno;
    }

    /**
     * Returns the value of field expiry_dt
     *
     * @return string
     */
    public function getExpiryDt()
    {
        return $this->expiry_dt;
    }

    /**
     * Returns the value of field cvv
     *
     * @return integer
     */
    public function getCvv()
    {
        return $this->cvv;
    }

    /**
     * Returns the value of field cardtype
     *
     * @return string
     */
    public function getCardtype()
    {
        return $this->cardtype;
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
        $this->setSource("usercard");
        $this->belongsTo('userid', 'models\User', 'userid', ['alias' => 'User']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'usercard';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Usercard[]|Usercard|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Usercard|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
