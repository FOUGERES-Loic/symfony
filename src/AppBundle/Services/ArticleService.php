<?php

namespace AppBundle\Services;

use AppBundle\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class ArticleService
{
    protected $em;
    protected $ms;
    protected $repo;

    /**
     * ArticleService constructor.
     * @param EntityManagerInterface $entityManager
     * @param MenuService $menuService
     */
    public function __construct(EntityManagerInterface $entityManager, MenuService $menuService)
    {
        $this->em = $entityManager;
        $this->repo = $this->em->getRepository('AppBundle:Article');
        $this->ms = $menuService;
    }

    /**
     * @return Article[]|array
     */
    public function getArticles()
    {
        return $this->repo->findAll();
    }

    /**
     * @param int $id
     * @return Article|object
     * @throws Exception
     */
    public function getArticle($id){
        $article = $this->repo->find($id);
        if (!$article)
            throw new Exception('Aucun article à cet identifiant ('.$id.')');
        return $article;
    }

    /**
     * @param Article|object $article
     * @return Article|object
     */
    public function saveArticle($article)
    {
        $this->em->persist($article);
        $this->em->flush();
        return $article;
    }

    /**
     * @param int $id
     * @return bool
     * @throws Exception
     */
    public function deleteArticle($id)
    {
        $article = $this->repo->find($id);
        if (!$article)
            throw new Exception('Aucun article à cet identifiant ('.$id.')');
        $this->em->remove($article);
        $this->em->flush();
        return true;
    }
}