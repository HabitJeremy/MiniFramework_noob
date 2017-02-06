<?php

namespace MagicMonkey\MiniJournal;

use MagicMonkey\MiniJournal\Article\ArticleBd;
use MagicMonkey\MiniJournal\Article\ArticleForm;
use MagicMonkey\MiniJournal\Article\ArticleHtml;

require_once 'app/MagicMonkey/Tools/Loader/Autoloader.php';
require_once 'config/config.php';

spl_autoload_register(array('\MagicMonkey\Tools\Loader\Autoloader', 'load'));

$title = "";
$content = "";

$action = empty($_GET["a"]) ? "home" : $_GET["a"];

switch ($action) {
    case "update":
        $title = "Modification d'un article";

        break;
    case "delete":
        $articleBd = new ArticleBd();
        $articleForm = new ArticleForm();
        $lstObjsArticles = $articleBd->selectAll();
        $title = "Suppression d'un article";
        if ((empty($_GET['id']) && !empty($_POST['article'])) || !empty($_GET['id'])) {
            $id = empty($_GET['id']) ? $_POST['article'] : $_GET['id'];
            if (!$articleBd->deleteOne($id)) { //suppression
                if (!empty($_POST['article'])) {
                    $_SESSION['errorArticle'] = "L'article doit être indiqué et doit existé";
                    $content = $articleForm->formDelete($lstObjsArticles);
                } else {
                    $title = "Error lors de la suppression de l'article";
                    $content = (new ArticleHtml())->errorMsg("Une erreur est survenue lors de la suppression de
                    l'article ! Il se peut que l'article n'existe plus.");
                }
            }
        } else {
            $content = $articleForm->formDelete($lstObjsArticles); // affichage du formulaire
        }
        break;
    case "new":
        $title = "Saisir un article";
        $articleForm = new ArticleForm();
        if (empty($_POST)) {
            $content = $articleForm->formNew();
        } else {
            if (!$articleForm->validateNew($_POST)) { // verif du formulaire : si aucune erreur
                (new ArticleBd())->addOne($_POST); /* enregistrement du nouvel article dans la bdd */
                header('Location: index.php'); // redirection
                exit();
            } else { // s'il y a au moins une erreur
                $content = $articleForm->formNew($_POST);
            }
        }
        break;
    case "home":
        $title = "Tous les articles";
        $lstObjsArticles = (new ArticleBd())->selectAll();
        $content = (new ArticleHtml())->listAll($lstObjsArticles);
        break;
    case "describe":
        if (!empty($_GET["id"])) {
            $articleHtml = new ArticleHtml();
            $article = (new ArticleBd())->selectOne(array("id =" => (int)$_GET['id']));
            if (!$article) {
                $title = "Article inexistant";
                $content = $articleHtml->errorMsg("L'article demandé n'existe pas !");
            } else {
                $title = "Détails d'un article";
                $content = $articleHtml->showOne($article);
            }
        } else {
            /*   si pas d'id renseigné ??? à@@@@@@@@@@  ! !! ! ! */
        }
        break;
    default:
        $title = "page inexistante";
        ob_start();
        include 'ui/commonViews/not-found.html';
        $content = ob_get_contents();
        ob_end_clean();
        break;
}

include "ui/layout/lBase.html";
