<?php
/**
 * Created by PhpStorm.
 * User: 21608681
 * Date: 26/01/17
 * Time: 14:30
 */

require 'common/config/config.php';
require 'common/config/autoload.php';
require 'common/tools/Database/DbConnection.php';

use \MagicMonkey\MiniJournal\Article\ArticleBd;
use \MagicMonkey\MiniJournal\Article\ArticleHtml;
use \Database\DbConnection;

spl_autoload_register('autoload');

$title = "";
$content = "";

/* connexion */
$dbh = DbConnection::getInstance()->getConnexion();
$articleBd = new ArticleBd($dbh);
$articleHtml = new ArticleHtml();

$action = empty($_GET["a"]) ? "home" : $_GET["a"];
switch ($action) {
    case "home":
        $title = "Accueil";
        $lstObjsArticles = $articleBd->selectAll();
        if (!$lstObjsArticles) {
            $content = "<h3>Erreur : impossible de récupérer les données</h3>";
        } else {
            $content = $articleHtml->listAll($lstObjsArticles);
        }
        break;
    case "describeArticle":
        if (!empty($_GET["id"])) {
            $title = "un article";
            $article = $articleBd->selectOne(array("id =" => $_GET['id']));
            if (!$article) {
                $content = "<h3>Erreur : impossible de récupérer le produit</h3>";
            } else {
                $content = $articleHtml->showOne($article);
            }
        }
        break;
    default:
        ob_start();
        include 'ui/pages/not-found.html';
        $content = ob_get_contents();
        ob_end_clean();
        break;
}

$dbh = null;

include "ui/layout/lBase.html";
