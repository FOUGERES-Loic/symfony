<?php

namespace AppBundle\Entity;


class Article
{
    /** @var int */
    protected $id;
    /** @var string */
    protected $title;
    /** @var string */
    protected $photo;
    /** @var string */
    protected $content;
    /** @var boolean */
    protected $published;
    /** @var \DateTime */
    protected $publishedAt;
    /** @var Menu[] */
    protected $menus;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Article
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Article
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param string $photo
     * @return Article
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return Article
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return bool
     */
    public function isPublished()
    {
        return $this->published;
    }

    /**
     * @param bool $published
     * @return Article
     */
    public function setPublished($published)
    {
        $this->published = $published;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * @param \DateTime $publishedAt
     * @return Article
     */
    public function setPublishedAt($publishedAt)
    {
        $this->publishedAt = $publishedAt;
        return $this;
    }

    /**
     * @return Menu[]
     */
    public function getMenus()
    {
        return $this->menus;
    }

    /**
     * @param Menu[] $menus
     * @return Article
     */
    public function setMenus($menus)
    {
        $this->menus = $menus;
        return $this;
    }

}