<?php
/**
 * Created by PhpStorm.
 * User: Jeremy
 * Date: 06/02/2017
 * Time: 15:46
 */

namespace MagicMonkey\MiniJournal\Article;

use MagicMonkey\Tools\Flash\FlashMessage;

class ArticleForm
{
    const LSTVALIDSTATUS = array("brouillon", "publie");

    /* show form new article */
    public function formNew($data = null)
    {
        $flash = FlashMessage::getInstance();
        ob_start();
        include 'views/vFormNew.html';
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    public function formDelete($lst)
    {
        $flash = FlashMessage::getInstance();
        ob_start();
        include 'views/vFormDelete.html';
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    /* Permet la vérifiction des données du formulaire */
    public function validateNew($postedData)
    {
        $error = false;
        /* title */
        if (empty($postedData['title']) || (strlen($postedData['title']) > 255)) {
            $error = true;
            $_SESSION['errorTitle'] = "Le titre doit être renseigné et ne doit pas dépasser 255 caractères";
        }
        /* author */
        if (empty($postedData['author']) || (strlen($postedData['author']) > 255)) {
            $_SESSION['errorAuthor'] = "L'auteur doit être renseigné et ne doit pas dépasser 255 caractères";
            $error = true;
        }
        /* content */
        if (empty($postedData['content'])) {
            $_SESSION['errorContent'] = "Le contenu doit être renseigné";
            $error = true;
        }
        /* chapo */
        if (empty($postedData['chapo'])) {
            $_SESSION['errorChapo'] = "Le 'chapo' doit être renseigné";
            $error = true;
        }
        /* status */
        if (empty($postedData['status']) || !in_array($postedData['status'], self::LSTVALIDSTATUS)) {
            $_SESSION['errorStatus'] = "Le statut doit être indiqué et doit correspondre à un statut valide";
            $error = true;
        }
        return $error;
    }
}
