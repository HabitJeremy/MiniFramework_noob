<?php

namespace MagicMonkey\MiniJournal\Article;

use \Exception;
use \PDO as PDO;

class ArticleBd
{
    private $dbh;
    private $objArticle;
    private $lstObjsArticle;

    /* ### CONSTRUCTOR ### */
    /**
     * ArticleBD constructor.
     * @param $dbh
     */
    public function __construct($dbh)
    {
        $this->dbh = $dbh;
        $this->lstObjsArticle = array();
    }

    /* ### SQL FUNCTIONS ### */

    /* select one */
    public function selectOne(array $conditions)
    {
        try {
            $lstPrepare = array();
            $sql = 'SELECT * from article where ';
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
            $this->objArticle = $this->map($res);
            return $this->objArticle;
        } catch (Exception $ex) {
            return false;
        }
    }

    /* select all */
    public function selectAll()
    {
        try {
            $sql = 'SELECT * from article';
            $sth = $this->dbh->query($sql);
            $res = $sth->fetchAll(PDO::FETCH_ASSOC);
            foreach ($res as $row) {
                $this->objArticle = $this->map($row);
                array_push($this->lstObjsArticle, $this->objArticle);
            }
            return $this->lstObjsArticle;
        } catch (Exception $ex) {
            return false;
        }
    }

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

    /* ### GETTERS & SETTES ### */
}
