<?php

namespace MagicMonkey\MiniJournal\Article;

class ArticleHtml
{
    private $startContent;
    private $endContent;

    public function __construct()
    {
        $this->startContent = "<div class='row'><div class='cell-12'>";
        $this->endContent = "</div></div>";
    }

    /* default list all articles */
    public function listAll($lst)
    {
        ob_start();
        include 'views/vAllArticles.html';
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    /* show one article */
    public function showOne($article)
    {
        ob_start();
        include 'views/vOneArticle.html';
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    public function errorMsg($msg)
    {
        return $this->startContent . "<p class='msg-error'>" . $msg . "</>" . $this->endContent;
    }
}
