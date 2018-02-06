<?php

namespace AppBundle\Controller;



use AppBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArticleController extends Controller
{
    public function getAllArticlesAction()
    {
        $article = new Article();

        $articles = [$article];
        return $this->render(
            'article/articles_list.html.twig',
            array('articles' => $articles)
        );
    }

    public function getArticleAction($id)
    {
        $article = new Article();
        return $this->render(
            'article/article_show.html.twig',
            array('article' => $article)
        );
    }
}