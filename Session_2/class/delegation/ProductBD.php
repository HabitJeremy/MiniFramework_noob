<?php

/**
 * Created by PhpStorm.
 * User: Jeremy
 * Date: 30/01/2017
 * Time: 18:20
 */
class ProductBD
{
    private $dbh;
    private $objProduct;
    private $lstObjsProduct;

    /* ### CONSTRUCTOR ### */
    /**
     * ProductBD constructor.
     * @param $dbh
     */
    public function __construct($dbh)
    {
        $this->dbh = $dbh;
        $this->lstObjsProduct = array();
    }

    /* ### SQL FUNCTIONS ### */

    /* select one */
    public function selectOne(array $conditions)
    {
        try {
            $lstPrepare = array();
            $sql = 'SELECT * from product where ';
            $i = 0;
            foreach ($conditions as $columnOperator => $value) {
                if ($i == 0) {
                    $sql .= $columnOperator . " :p" . $i;
                } else {
                    $sql .= " and " . $columnOperator . " :p" . $i;
                }
                $lstPrepare[":p" . $i] = $value;
            }
            $sth = $this->dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute($lstPrepare);
            $res = $sth->fetch(PDO::FETCH_ASSOC);
            $this->objProduct = new Product($res['productCode'], $res['productName'], $res['productLine'], $res['productScale'],
                $res['productVendor'], $res['productDescription'], $res['quantityInStock'], $res['buyPrice'], $res['MSRP']);
            return $this->objProduct;
        } catch (Exception $ex) {
            return false;
        }
    }

    /* select all */
    public function selectAll()
    {
        try {
            $sql = 'SELECT * from product';
            $sth = $this->dbh->query($sql);
            $res = $sth->fetchAll(PDO::FETCH_ASSOC);
            foreach ($res as $row) {
                $this->objProduct = new Product($row['productCode'], $row['productName'], $row['productLine'], $row['productScale'],
                    $row['productVendor'], $row['productDescription'], $row['quantityInStock'], $row['buyPrice'], $row['MSRP']);
                array_push($this->lstObjsProduct, $this->objProduct);
            }
            return $this->lstObjsProduct;
        } catch (Exception $ex) {
            return false;
        }
    }

    /* ### GETTERS & SETTERS ###*/

    /**
     * @return mixed
     */
    public function getDbh()
    {
        return $this->dbh;
    }

    /**
     * @param mixed $dbh
     */
    public function setDbh($dbh)
    {
        $this->dbh = $dbh;
    }

    /* ### GETTERS & SETTES ### */

}