<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use AppBundle\Services\ArticleService;
use AppBundle\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;
use Symfony\Component\HttpFoundation\Request;

class ArticleController extends Controller
{
    protected $service;
    protected $parser;

    /**
     * ArticleController constructor.
     * @param $articles Article[]
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

    public function newArticleAction(Request $request)
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dump($article);die;
        }

        return $this->render('@App/article/article_create.html.twig', [
            'form' => $form->createView()
        ]);
    }
}