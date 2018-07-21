<?php

namespace App\Models;

class Product extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $prodid;

    /**
     *
     * @var string
     */
    protected $prod_name;

    /**
     *
     * @var integer
     */
    protected $categoryid;

    /**
     *
     * @var string
     */
    protected $brand_name;

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
     * Method to set the value of field prod_name
     *
     * @param string $prod_name
     * @return $this
     */
    public function setProdName($prod_name)
    {
        $this->prod_name = $prod_name;

        return $this;
    }

    /**
     * Method to set the value of field categoryid
     *
     * @param integer $categoryid
     * @return $this
     */
    public function setCategoryid($categoryid)
    {
        $this->categoryid = $categoryid;

        return $this;
    }

    /**
     * Method to set the value of field brand_name
     *
     * @param string $brand_name
     * @return $this
     */
    public function setBrandName($brand_name)
    {
        $this->brand_name = $brand_name;

        return $this;
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
     * Returns the value of field prod_name
     *
     * @return string
     */
    public function getProdName()
    {
        return $this->prod_name;
    }

    /**
     * Returns the value of field categoryid
     *
     * @return integer
     */
    public function getCategoryid()
    {
        return $this->categoryid;
    }

    /**
     * Returns the value of field brand_name
     *
     * @return string
     */
    public function getBrandName()
    {
        return $this->brand_name;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("gayathrib");
        $this->setSource("product");
        $this->hasMany('prodid', 'models\Cart', 'prodid', ['alias' => 'Cart']);
        $this->hasMany('prodid', 'models\ProductByOrder', 'prodid', ['alias' => 'ProductByOrder']);
        $this->hasMany('prodid', 'models\ProductByStore', 'prodid', ['alias' => 'ProductByStore']);
        $this->belongsTo('categoryid', 'models\Category', 'categoryid', ['alias' => 'Category']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'product';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Product[]|Product|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Product|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
