<?php

namespace AppBundle\Services;

use AppBundle\Entity\Article;
use AppBundle\Entity\Menu;

class ArticleService
{
    protected $articles;

    /**
     * ArticleService constructor.
     */
    public function __construct()
    {
        $menu = new Menu();
        $menu->setId(1)->setTitle('TestMenu');
        $content = file_get_contents('http://loripsum.net/api/long');
        $article1 = new Article();
        $article1->setId(1)->setContent($content)->setTitle('article1')->setMenu($menu)
            ->setPhoto('pomme.jpg')->setPublished(true)->setPublishedAt(new \DateTime('2018-02-07 08:00'));
        $article2 = new Article();
        $article2->setId(2)->setContent($content)->setTitle('article2')->setMenu($menu)
            ->setPhoto('pomme.jpg')->setPublished(false)->setPublishedAt(new \DateTime('2018-02-06 08:00'));;
        $article3 = new Article();
        $article3->setId(3)->setContent($content)->setTitle('article3')->setMenu($menu)
            ->setPhoto('pomme.jpg')->setPublished(true)->setPublishedAt(new \DateTime('2018-02-05 08:00'));;
        $this->articles = [1=>$article1,2=>$article2,3=>$article3];
    }

    /**
     * @return mixed
     */
    public function getArticles()
    {
        return $this->articles;
    }

    public function getArticle($id)
    {
        return $this->articles[$id];
    }

}