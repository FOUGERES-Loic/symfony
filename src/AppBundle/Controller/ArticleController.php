<?php

namespace AppBundle\Controller;

use AppBundle\Services\ArticleService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;

class ArticleController extends Controller
{
    protected $service;
    protected $parser;

    /**
     * ArticleController constructor.
     * @param $articles
     */
    public function __construct(ArticleService $articleService, MarkdownParserInterface $parser)
    {
        $this->service = $articleService;
        $this->parser = $parser;

    }

    public function getAllArticlesAction()
    {
        return $this->render(
            '@App/article/articles_list.html.twig',
            array('articles' => $this->service->getArticles())
        );
    }

    public function getArticleAction($id)
    {
        return $this->render(
            '@App/article/article_show.html.twig',
            array('article' => $this->service->getArticle($id))
        );
    }
}