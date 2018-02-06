<?php

namespace AppBundle\Entity;


class Menu
{
    /** @var int */
    protected $id;
    /** @var string */
    protected $title;
    /** @var Menu */
    protected $parent;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Menu
     */
    public function setId(int $id): Menu
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Menu
     */
    public function setTitle(string $title): Menu
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return Menu
     */
    public function getParent(): Menu
    {
        return $this->parent;
    }

    /**
     * @param Menu $parent
     * @return Menu
     */
    public function setParent(Menu $parent): Menu
    {
        $this->parent = $parent;
        return $this;
    }
}