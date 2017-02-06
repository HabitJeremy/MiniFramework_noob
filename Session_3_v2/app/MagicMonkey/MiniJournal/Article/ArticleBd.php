<?php

namespace MagicMonkey\MiniJournal\Article;

use \Exception;
use \PDO as PDO;
use MagicMonkey\Tools\Database\DbConnection;

class ArticleBd
{
    const TABLE_NAME = "article";
    private $dbh;

    /* ### CONSTRUCTOR ### */
    /**
     * ArticleBD constructor.
     */
    public function __construct()
    {
        $this->dbh = DbConnection::getInstance()->getConnexion();
    }

    /* ### SQL FUNCTIONS ### */

    /* select one */
    public function selectOne(array $conditions)
    {
        try {
            $lstPrepare = array();
            $sql = 'SELECT * from '.self::TABLE_NAME.' where ';
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
            return $this->map($res);
        } catch (Exception $ex) {
            return false;
        }
    }

    /* select all */
    public function selectAll()
    {
        try {
            $lstObjsArticle = array();
            $sql = 'SELECT * from '.self::TABLE_NAME;
            $sth = $this->dbh->query($sql);
            $res = $sth->fetchAll(PDO::FETCH_ASSOC);
            foreach ($res as $row) {
                array_push($lstObjsArticle, $this->map($row));
            }
            return $lstObjsArticle;
        } catch (Exception $ex) {
            return false;
        }
    }

    /* Creation of an object Article */
    private function map($res)
    {
        return new Article($res['id'], $res['title'], $res['chapo'], $res['content'],
            $res['publication_status'], $res['creation_date'], $res['publication_date']);
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
}
