<?php

namespace MagicMonkey\MiniJournal\Article;

use \Exception;
use \PDO as PDO;
use MagicMonkey\Tools\Database\DbConnection;
use MagicMonkey\Tools\Database\Cleaner;

class ArticleBd
{
    const TABLE_NAME = "article";
    private $dbh;
    private $cleaner;

    /* ### CONSTRUCTOR ### */
    /**
     * ArticleBD constructor.
     */
    public function __construct()
    {
        $this->dbh = DbConnection::getInstance()->getConnexion();
        $this->cleaner = new Cleaner();
    }

    /* ### SQL FUNCTIONS ### */

    /* select one */
    public function selectOne(array $conditions)
    {
        try {
            $lstPrepare = array();
            $sql = 'SELECT * from ' . self::TABLE_NAME . ' where ';
            $i = 0;
            foreach ($conditions as $columnOperator => $value) {
                if ($i == 0) {
                    $sql .= $columnOperator . " :p" . $i;
                } else {
                    $sql .= " and " . $columnOperator . " :p" . $i;
                }
                $lstPrepare[":p" . $i] = $value;
            }
            $stmt = $this->dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $stmt->execute($lstPrepare);
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($res) {
                return $this->map($res);
            } else {
                return $res;
            }
        } catch (Exception $ex) {
            return false;
        }
    }

    /* select all */
    public function selectAll()
    {
        try {
            $lstObjsArticle = array();
            $sql = 'SELECT * from ' . self::TABLE_NAME;
            $stmt = $this->dbh->query($sql);
            if ($res = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
                foreach ($res as $row) {
                    array_push($lstObjsArticle, $this->map($row));
                }
                return $lstObjsArticle;
            } else {
                return false;
            }
        } catch (Exception $ex) {
            return false;
        }
    }

    /* suppression d'un article => return false si error sinon => redirection */
    public function deleteOne($id)
    {
        $res = false;
        $article = $this->selectOne(array("id =" => (int)$id));
        if ($article) {
            $sql = 'DELETE from ' . self::TABLE_NAME . ' where id = :id';
            $stmt = $this->dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            if ($stmt->execute(array(":id" => $id))) {
                header('Location: index.php'); // redirection
                exit();
            }
        }
        return $res;
    }

    /* ajout d'un article */
    public function addOne($postedData)
    {
        try {
            $postedData['creationDate'] = date("Y-m-d");
            if ($postedData['status'] == "publie") {
                $postedData['publicationDate'] = date("Y-m-d");
            } else {
                $postedData['publicationDate'] = null;
            }
            $sql = 'INSERT INTO ' . self::TABLE_NAME;
            $sql .= ' (author, title, chapo, content, publication_status, creation_date, publication_date)';
            $sql .= ' VALUES (:author, :title, :chapo, :content, :status, :creationDate, :publicationDate)';
            $stmt = $this->dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            return $stmt->execute($postedData);
        } catch (Exception $ex) {
            return false;
        }
    }

    /* Creation of an object Article */
    private function map($res)
    {
        $this->cleaner->cleanerArray($res);
        return new Article($res['id'], $res['title'], $res['author'], $res['chapo'], $res['content'],
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
