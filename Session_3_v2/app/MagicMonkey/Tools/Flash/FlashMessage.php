<?php

namespace MagicMonkey\Tools\Flash;

class FlashMessage
{
    /**
     * $instance est privée pour implémenter le pattern Singleton
     * et être sûr qu'il n'y a qu'une et une seule instance
     */
    private static $instance;

    /**
     * Méthode pour accéder à l'UNIQUE instance de la classe.
     *
     * @return l'instance du singleton
     */
    public static function getInstance()
    {
        if (!(self::$instance instanceof self)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /*
        * Permet d'afficher la valeur d'une variable de session puis de la détruire
        * Paramètres :
*          - $name : nom de la variable de session
*          - $error : détermine l'affichage de la variable de session (false => la valeur , true => valeur + tags html)
       */
    public function flash($name, $error = false)
    {
        if (!empty($_SESSION[$name])) {
            if (!$error) {
                echo $_SESSION[$name]; // variable de session de "valeur"
            } else {
                // variable de session "d'erreur"
                echo "<span class='msg-error marg-10-bottom'>" . $_SESSION[$name] . "</span>";
            }
            unset($_SESSION[$name]); // destruction de la variabe de session
        }
    }
}
