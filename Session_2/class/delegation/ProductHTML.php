<?php

/**
 * Created by PhpStorm.
 * User: Jeremy
 * Date: 30/01/2017
 * Time: 18:21
 */
class ProductHTML
{

    private $contentStart;
    private $contentEnd;

    public function __construct()
    {
        $this->contentStart = "<div class='row'><div class='cell-12'>";
        $this->contentEnd = "</div></div>";
    }

    /* default list all products */
    public function listAll($lst)
    {
        try {
            $content = $this->contentStart;
            $content .= "<ul>";
            foreach ($lst as $product) {
                $content .= "<li><a href='index.php?a=describe&id=" . $product->getCode() . "'>" . $product->getName() . "</a></li>";
            }
            $content .= "</ul>";
            $content .= $this->contentEnd;
            return $content;
        } catch (Exception $ex) {
            return false;
        }
    }

    /* show one product */
    public function showOne($obj)
    {
        try {
            $content = $this->contentStart;
            $content .= "<a href='index.php'>Retour</a>";
            $content .= "<h1>" . $obj->getName() . "</h1>";
            $content .= "<p>" . $obj->getDescription() . "</p>";
            $content .= $this->contentEnd;
            return $content;
        } catch (Exception $ex) {
            return false;
        }
    }

}