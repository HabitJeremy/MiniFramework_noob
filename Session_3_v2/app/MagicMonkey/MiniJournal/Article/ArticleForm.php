<?php
/**
 * Created by PhpStorm.
 * User: Jeremy
 * Date: 06/02/2017
 * Time: 15:46
 */

namespace MagicMonkey\MiniJournal\Article;

class ArticleForm
{
    const LSTVALIDSTATUS = array("brouillon", "publie");

    private $errors;

    public function __construct()
    {
        $this->errors = array();
    }

    /* Permet l'affichage des notifications/messages afin d'informer l'utilisateur */
    public function showMsg($key, $error = true)
    {
        $res = "";
        if (array_key_exists($key, $this->errors)) {
            $class = "error";
            if (!$error) {
                $class = "success";
            }
            $res = "<p class='msg-" . $class . " marg-10-bottom'>";
            $res .= $this->errors[$key];
            $res .= "</p>";
        }
        return $res;
    }

    /* show form new article */
    public function formNew($data = null)
    {
        ob_start();
        include 'views/vFormNew.html';
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    /* show form delete article */
    public function formDelete($lst)
    {
        ob_start();
        include 'views/vFormDelete.html';
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    /* Permet la vérifiction des données du formulaire " Nouveau " */
    public function validateNew($postedData)
    {
        $error = false;
        /* title */
        if (empty($postedData['title']) || (strlen($postedData['title']) > 255)) {
            $error = true;
            $this->errors["errorTitle"] = "Le titre doit être renseigné et ne doit pas dépasser 255 caractères";
        }
        /* author */
        if (empty($postedData['author']) || (strlen($postedData['author']) > 255)) {
            $this->errors["errorAuthor"] = "L'auteur doit être renseigné et ne doit pas dépasser 255 caractères";
            $error = true;
        }
        /* content */
        if (empty($postedData['content'])) {
            $this->errors["errorContent"] = "Le contenu doit être renseigné";
            $error = true;
        }
        /* chapo */
        if (empty($postedData['chapo'])) {
            $this->errors["errorChapo"] = "Le 'chapo' doit être renseigné";
            $error = true;
        }
        /* status */
        if (empty($postedData['status']) || !in_array($postedData['status'], self::LSTVALIDSTATUS)) {
            $this->errors['errorStatus'] = "Le statut doit être indiqué et doit correspondre à un statut valide";
            $error = true;
        }
        return $error;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param array $errors
     */
    public function setErrors($errors)
    {
        $this->errors = $errors;
    }

    /* ajout d'une erreur dans l'array errors */
    public function addErrors($newItem)
    {
        array_push($this->errors, $newItem);
    }
}
