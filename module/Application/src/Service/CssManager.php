<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 01/01/2020
 * Time: 12:01
 */

namespace Application\Service;


use Application\Entity\CssAttribute;
use Application\Entity\CssClass;
use Application\Entity\Forum;
use Doctrine\Common\Util\Debug;
use Doctrine\ORM\EntityManager;

class CssManager
{
    protected $entityManager;

    public function __construct(EntityManager $em)
    {
        $this->entityManager = $em;
    }

    public function addClass(array $data, Forum $forum)
    {

        $entity = new CssClass();
        $entity->setName($data['name']);
        $entity->setForumId($forum->getId());
        $entity->setType($data['type']);

        $this->entityManager->persist($entity);
        $this->entityManager->flush();

    }

    public function newAttribute(array $data)
    {
        //die(var_dump($data));
        $entity = new CssAttribute();
        $class = $this->entityManager->getRepository(CssClass::class)->find($data['class_id']);
        $entity->setName($data['name']);
        $entity->setAttribute($data['attribute']);
        $entity->setAddendum($data['addendum']);
        $entity->setClass($class);
        $entity->setClassId($class->getId());
//die(Debug::dump($entity));
        $this->entityManager->persist($entity);
        $this->entityManager->flush();

    }

    public function updAttribute(array $data)
    {
        //die(var_dump($data));
        $entity = $this->entityManager->getRepository(CssAttribute::class)->find($data['attr_id']);
        $entity->setName($data['name']);
        $entity->setAttribute($data['attribute']);
        $entity->setAddendum($data['addendum']);

        $this->entityManager->persist($entity);
        $this->entityManager->flush();

    }

    public function deleteAttribute(array $data)
    {
        $entity = $this->entityManager->getRepository(CssAttribute::class)->find($data['class_id']);
        $this->entityManager->remove($entity);
        $this->entityManager->flush();

    }

}