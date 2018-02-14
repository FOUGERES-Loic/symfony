<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use AppBundle\Entity\Menu;
use AppBundle\Form\MenuType;
use AppBundle\Services\ArticleService;
use AppBundle\Form\ArticleType;
use AppBundle\Services\MenuService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ArticleController extends Controller
{
    protected $parser;

    /**
     * ArticleController constructor.
     * @param $articles Article[]
     */
    public function __construct(MarkdownParserInterface $parser)
    {
        $this->parser = $parser;
    }

    public function getAllArticlesAction(SessionInterface $session, ArticleService $service)
    {
        $lastArticle = $session->get('article');
        return $this->render(
            '@App/article/articles_list.html.twig',
            array('articles' => $service->getArticles(), 'lastArticle' => $lastArticle)
        );
    }

    public function getPublicArticlesAction(SessionInterface $session, ArticleService $service)
    {
        $lastArticle = $session->get('article');
        return $this->render(
            '@App/article/articles_public.html.twig',
            array('articles' => $service->getPublishedArticles(), 'lastArticle' => $lastArticle)
        );
    }

    public function getArticleAction(SessionInterface $session, $id, ArticleService $service)
    {
        $article = $service->getArticle($id);
        $session->set('article', $article);
        return $this->render(
            '@App/article/article_show.html.twig',
            array('article' => $article)
        );
    }

    public function newArticleAction(SessionInterface $session, Request $request, ArticleService $service, $id = null)
    {
        if (!$id) {
            $article = new Article();
            $create = true;
        } else {
            $article = $service->getArticle($id);
            $create = false;
        }
        $fileName = $article->getPhoto();

        if ($fileName) {
            $article->setPhoto(new File($this->getParameter('images_directory').'/'.$fileName));
        }
        $form = $this->createForm(ArticleType::class, $article, ['current_id' => $article->getId()]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $article->getPhoto();
//            $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();

            if ($file) {
                if($fileName) {
                    $fs = new Filesystem();
                    $fs->remove($this->getParameter('images_directory') . '/' . $fileName);
                }
                $fileName = uniqid().'.'.$file->guessExtension();
                // moves the file to the directory where brochures are stored
                $file->move(
                    $this->getParameter('images_directory'),
                    $fileName
                );
            }

            if ($create) $article->setAuthor($this->getUser());

            $article->setPhoto($fileName);
            $service->saveArticle($article);
            if ($create) {
                $this->addFlash('success', 'Produit créé!');
            } else {
                $this->addFlash('success', 'Produit mis à jour!');
            }

            return $this->redirectToRoute('articles_admin');
        }

        return $this->render('@App/article/article_create.html.twig', [
            'form' => $form->createView(),
            'create' => $create,
        ]);
    }

    public function newMenuAction(SessionInterface $session, Request $request, MenuService $service, $id = null)
    {
        if (!$id) {
            $menu = new Menu();
            $create = true;
        } else {
            $menu = $service->getOne($id);
            $create = false;
        }

        $form = $this->createForm(MenuType::class, $menu);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $service->save($menu);
            if ($create) {
                $this->addFlash('success', 'Menu créé!');
            } else {
                $this->addFlash('success', 'Menu mis à jour!');
            }

            return $this->redirectToRoute('articles_admin');
        }

        return $this->render('@App/article/article_create.html.twig', [
            'form' => $form->createView(),
            'create' => $create,
        ]);
    }

    public function deleteArticleAction(SessionInterface $session, $id, ArticleService $service)
    {
        $service->deleteArticle($id);
        $this->addFlash('success', 'Produit supprimé!');
        return $this->redirectToRoute('articles_admin');
    }

    public function deleteMenuAction(SessionInterface $session, $id, MenuService $service)
    {
        $service->delete($id);
        $this->addFlash('success', 'Menu supprimé!');
        return $this->redirectToRoute('articles_admin');
    }

    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }
}