<?php

namespace MagicMonkey\MiniJournal\Article;

use \Exception;

class ArticleHtml
{

    private $contentStart;
    private $contentEnd;

    public function __construct()
    {
        $this->contentStart = "<div class='row'><div class='cell-12'>";
        $this->contentEnd = "</div></div>";
    }

    /* default list all articles */
    public function listAll($lst)
    {
        try {
            $content = $this->contentStart;
            $content .= "<ul>";
            foreach ($lst as $article) {
                $content .= "<li><a href='index.php?a=describeArticle&id=" . $article->getId() . "'>";
                $content .= $article->getTitle() . "</a></li>";
            }
            $content .= "</ul>";
            $content .= $this->contentEnd;
            return $content;
        } catch (Exception $ex) {
            return false;
        }
    }

    /* show one article */
    public function showOne($obj)
    {
        try {
            $content = $this->contentStart;
            $content .= "<a href='index.php'>Retour</a>";
            $content .= "<h1>" . $obj->getTitle() . "</h1>";
            $content .= "<p>" . $obj->getChapo() . "</p>";
            $content .= "<p>" . $obj->getContent() . "</p>";
            $content .= $this->contentEnd;
            return $content;
        } catch (Exception $ex) {
            return false;
        }
    }
}
