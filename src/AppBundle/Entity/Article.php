<?php

namespace AppBundle\Entity;

use Gedmo\Timestampable\Traits\TimestampableEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="article")
 */
class Article
{
    /**
     * Hook timestampable behavior
     * updates createdAt, updatedAt fields
     */
    use TimestampableEntity;

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $title;
    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $photo;
    /**
     * @ORM\Column(type="text")
     */
    protected $content;
    /**
     * @ORM\Column(type="boolean")
     */
    protected $published;
    /**
     * @ORM\Column(type="datetime", name="published_at")
     */
    protected $publishedAt;
    /**
     * @ORM\ManyToOne(targetEntity="Menu")
     */
    protected $menu;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */
    protected $author;
    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Article", inversedBy="linkedby")
     */
    protected $linkedto;
    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Article", mappedBy="linkedto")
     */
    protected $linkedby;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Article
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set photo
     *
     * @param string $photo
     *
     * @return Article
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Article
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set published
     *
     * @param boolean $published
     *
     * @return Article
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return boolean
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * Set publishedAt
     *
     * @param \DateTime $publishedAt
     *
     * @return Article
     */
    public function setPublishedAt($publishedAt)
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    /**
     * Get publishedAt
     *
     * @return \DateTime
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * Set menu
     *
     * @param \AppBundle\Entity\Menu $menu
     *
     * @return Article
     */
    public function setMenu(\AppBundle\Entity\Menu $menu = null)
    {
        $this->menu = $menu;

        return $this;
    }

    /**
     * Get menu
     *
     * @return \AppBundle\Entity\Menu
     */
    public function getMenu()
    {
        return $this->menu;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->linkedto = new \Doctrine\Common\Collections\ArrayCollection();
        $this->linkedby = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add linkedto
     *
     * @param \AppBundle\Entity\Article $linkedto
     *
     * @return Article
     */
    public function addLinkedto(\AppBundle\Entity\Article $linkedto)
    {
        $this->linkedto[] = $linkedto;
        $linkedto->addLinkedby($this);

        return $this;
    }

    /**
     * Remove linkedto
     *
     * @param \AppBundle\Entity\Article $linkedto
     */
    public function removeLinkedto(\AppBundle\Entity\Article $linkedto)
    {
        $this->linkedto->removeElement($linkedto);
    }

    /**
     * Get linkedto
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLinkedto()
    {
        return $this->linkedto;
    }

    /**
     * Add linkedby
     *
     * @param \AppBundle\Entity\Article $linkedby
     *
     * @return Article
     */
    public function addLinkedby(\AppBundle\Entity\Article $linkedby)
    {
        $this->linkedby[] = $linkedby;
        $linkedby->addLinkedto($this);

        return $this;
    }

    /**
     * Remove linkedby
     *
     * @param \AppBundle\Entity\Article $linkedby
     */
    public function removeLinkedby(\AppBundle\Entity\Article $linkedby)
    {
        $this->linkedby->removeElement($linkedby);
    }

    /**
     * Get linkedby
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLinkedby()
    {
        return $this->linkedby;
    }

    /**
     * Set author
     *
     * @param \AppBundle\Entity\User $author
     *
     * @return Article
     */
    public function setAuthor(\AppBundle\Entity\User $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \AppBundle\Entity\User
     */
    public function getAuthor()
    {
        return $this->author;
    }
}
