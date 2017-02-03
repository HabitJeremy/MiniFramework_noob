<?php

/**
 * Created by PhpStorm.
 * User: Jeremy
 * Date: 30/01/2017
 * Time: 18:20
 */
class Product
{

    private $code;
    private $name;
    private $line;
    private $scale;
    private $vendor;
    private $description;
    private $buyPrice;
    private $qteStock;
    private $msrp;

    /* ### CONSTRUCTOR & TOSTRING ### */

    /**
     * Product constructor.
     * @param $code
     * @param $name
     * @param $line
     * @param $scale
     * @param $vendor
     * @param $description
     * @param $buyPrice
     * @param $qteStock
     * @param $msrp
     */
    public function __construct($code, $name, $line, $scale, $vendor, $description, $qteStock, $buyPrice, $msrp)
    {
        $this->code = $code;
        $this->name = $name;
        $this->line = $line;
        $this->scale = $scale;
        $this->vendor = $vendor;
        $this->description = $description;
        $this->buyPrice = $buyPrice;
        $this->qteStock = $qteStock;
        $this->msrp = $msrp;
    }

    public function toString(){
        echo $this->name;
    }

    /* ### GETTERS & SETTES */

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getLine()
    {
        return $this->line;
    }

    /**
     * @param mixed $line
     */
    public function setLine($line)
    {
        $this->line = $line;
    }

    /**
     * @return mixed
     */
    public function getScale()
    {
        return $this->scale;
    }

    /**
     * @param mixed $scale
     */
    public function setScale($scale)
    {
        $this->scale = $scale;
    }

    /**
     * @return mixed
     */
    public function getVendor()
    {
        return $this->vendor;
    }

    /**
     * @param mixed $vendor
     */
    public function setVendor($vendor)
    {
        $this->vendor = $vendor;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getBuyPrice()
    {
        return $this->buyPrice;
    }

    /**
     * @param mixed $buyPrice
     */
    public function setBuyPrice($buyPrice)
    {
        $this->buyPrice = $buyPrice;
    }

    /**
     * @return mixed
     */
    public function getQteStock()
    {
        return $this->qteStock;
    }

    /**
     * @param mixed $qteStock
     */
    public function setQteStock($qteStock)
    {
        $this->qteStock = $qteStock;
    }

    /**
     * @return mixed
     */
    public function getMsrp()
    {
        return $this->msrp;
    }

    /**
     * @param mixed $msrp
     */
    public function setMsrp($msrp)
    {
        $this->msrp = $msrp;
    }


}