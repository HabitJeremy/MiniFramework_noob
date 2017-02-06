<?php

namespace MagicMonkey\MiniJournal;

use MagicMonkey\MiniJournal\Article\ArticleBd;
use MagicMonkey\MiniJournal\Article\ArticleHtml;

require_once 'app/MagicMonkey/Tools/Loader/Autoloader.php';
require_once 'config/config.php';

spl_autoload_register(array('\MagicMonkey\Tools\Loader\Autoloader', 'load'));

$title = "";
$content = "";

$action = empty($_GET["a"]) ? "home" : $_GET["a"];

switch ($action) {
    case "home":
        $title = "Tous les articles";
        $lstObjsArticles = (new ArticleBd())->selectAll();
        if (!$lstObjsArticles) {
            $content = "<h3>Erreur : impossible de récupérer les données</h3>";
        } else {
            $content = (new ArticleHtml())->listAll($lstObjsArticles);
        }
        break;
    case "describeArticle":
        if (!empty($_GET["id"])) {
            $title = "Détails d'un article";
            $article = (new ArticleBd())->selectOne(array("id =" => (int) $_GET['id']));
            if (!$article) {
                $content = "<h3>Erreur : impossible de récupérer l'article demandé</h3>";
            } else {
                $content = (new ArticleHtml())->showOne($article);
            }
        }
        break;
    default:
        ob_start();
        include 'ui/commonViews/not-found.html';
        $content = ob_get_contents();
        ob_end_clean();
        break;
}

include "ui/layout/lBase.html";
