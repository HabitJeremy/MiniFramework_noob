<?php
/**
 * Created by PhpStorm.
 * User: 21608681
 * Date: 26/01/17
 * Time: 14:30
 */

require 'config/config.php';
require 'class/singleton.php';


$title = "";
$content = "";

/* connexion */
$dbh = Bd::getInstance()->getConnexion();

if (!empty($_GET["a"])) {
    switch ($_GET["a"]) {
        case "describe":
            if (!empty($_GET["id"])) {
                /* requête */
                $sql = 'SELECT productName, productDescription from products where productCode = :productCode';
                $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(':productCode' => $_GET['id']));
                $res = $sth->fetch(PDO::FETCH_ASSOC);
                /* traitement */
                $titre = $res["productName"];
                $content = "<a href='index.php\'>Retour</a>";
                $content .= "<h1>" . $res["productName"] . "</h1>";
                $content .= "<p>" . $res["productDescription"] . "</p>";
                $dbh = null;
            }
            break;
    }
}

if($content == null || $content == ""){
    $sql = 'SELECT * from products';
    $sth = $dbh->query($sql);
    $res = $sth->fetchAll(PDO::FETCH_ASSOC);
    $content = "<ul>";
    foreach ($res as $ligne) {
        $content .= "<li><a href='index.php?a=describe&id=" . $ligne["productCode"] . "'>" . $ligne["productName"] . "</a></li>";
    }
    $content .= "</ul>";
    $dbh = null;
}

include "base.html";
