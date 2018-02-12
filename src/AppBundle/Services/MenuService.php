<?php
/**
 * Created by PhpStorm.
 * User: HB1
 * Date: 09/02/2018
 * Time: 11:01
 */

namespace AppBundle\Services;

use Doctrine\ORM\EntityManagerInterface;
use Exception;

class MenuService
{
    protected $em;
    protected $repo;

    /**
     * MenuService constructor.
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
        $this->repo = $this->em->getRepository('AppBundle:Menu');
    }

    /**
     * @return \AppBundle\Entity\Menu[]|array
     */
    public function getAll()
    {
        return $this->repo->findAll();
    }

    /**
     * @param int $id
     * @return \AppBundle\Entity\Menu|object
     * @throws Exception
     */
    public function getOne($id)
    {
        $menu = $this->repo->find($id);
        if (!$menu)
            throw new Exception('Aucun menu à cet identifiant ('.$id.')');
        return $menu;
    }

    /**
     * @param Menu $menu
     * @return Menu
     */
    public function save($menu)
    {
        $this->em->persist($menu);
        $this->em->flush();
        return $menu;
    }

    /**
     * @param int $id
     * @return bool
     * @throws Exception
     */
    public function delete($id)
    {
        $menu = $this->repo->find($id);
        if (!$menu)
            throw new Exception('Aucun menu à cet identifiant ('.$id.')');
        $this->em->remove($menu);
        $this->em->flush();
        return true;
    }

    public function getParentMenus()
    {
        return $this->repo->findBy(['parent' => null]);
    }
}