<?php

namespace MagicMonkey\MiniJournal\Article;

class Article
{
    private $id;
    private $title;
    private $author;
    private $chapo;
    private $content;
    private $publicationStatus;
    private $creationDate;
    private $publicationDate;

    /**
     * Article constructor.
     * @param $id
     * @param $title
     * @param $author
     * @param $chapo
     * @param $content
     * @param $publicationStatus
     * @param $creationDate
     * @param $publicationDate
     */
    public function __construct(
        $id,
        $title,
        $author,
        $chapo,
        $content,
        $publicationStatus,
        $creationDate,
        $publicationDate = null
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->chapo = $chapo;
        $this->content = $content;
        $this->publicationStatus = $publicationStatus;
        $this->creationDate = $creationDate;
        $this->publicationDate = $publicationDate == null ? "?" : $publicationDate;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getChapo()
    {
        return $this->chapo;
    }

    /**
     * @param mixed $chapo
     */
    public function setChapo($chapo)
    {
        $this->chapo = $chapo;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getPublicationStatus()
    {
        return $this->publicationStatus;
    }

    /**
     * @param mixed $publicationStatus
     */
    public function setPublicationStatus($publicationStatus)
    {
        $this->publicationStatus = $publicationStatus;
    }

    /**
     * @return mixed
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * @param mixed $creationDate
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
    }

    /**
     * @return mixed
     */
    public function getPublicationDate()
    {
        return $this->publicationDate;
    }

    /**
     * @param mixed $publicationDate
     */
    public function setPublicationDate($publicationDate)
    {
        $this->publicationDate = $publicationDate;
    }
}
