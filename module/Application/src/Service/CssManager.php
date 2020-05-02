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
use Doctrine\Common\Annotations\Annotation\Attribute;
use Doctrine\Common\Util\Debug;
use Doctrine\ORM\EntityManager;

class CssManager
{

    const DISPATCH_ATTR = 1;
    const DISPATCH_CLASS = 2;

    protected $entityManager;

    public function __construct(EntityManager $em)
    {
        $this->entityManager = $em;
    }

    public function dispatch($dispatch, $data, $forum)
    {
        switch($dispatch)
        {
            case self::DISPATCH_ATTR:
                $this->updAttribute($data);
                break;
            case self::DISPATCH_CLASS:
                $this->updClass($data, $forum);
                break;
            default:
                throw new \Exception('dispatcher en vrac');

        }
    }

    public function updClass(array $data, Forum $forum)
    {
        $entity = new CssClass();
        $entity->setName($data['name']);
        $entity->setForumId($forum->getId());
        $entity->setType($data['type']);

        $this->entityManager->persist($entity);
        $this->entityManager->flush();

    }


    public function updAttribute(array $data)
    {
        if(!isset($data['id'])){
            $data['id'] = 0;
        }
        $entity = $this->entityManager->getRepository(CssAttribute::class)->find($data['id']);
        if(!$entity){
            $entity = new CssAttribute();
        }
        $entity->setName($data['name']);
        $entity->setAttribute($data['attribute']);
        $entity->setAddendum($data['addendum']);
        $class = $this->entityManager->getRepository(CssClass::class)->find($data['class_id']);
        if(!$class){
            throw new \Exception('Vous essayez d\'enregistrer un attribut dans une classe inexistante');
        }
        $entity->setClass($class);

        $this->entityManager->persist($entity);
        $this->entityManager->flush();

    }

    public function deleteAttribute(CssAttribute $attr)
    {
        $this->entityManager->remove($attr);
        $this->entityManager->flush();
    }

    public function deleteClass(CssClass $class)
    {
        $this->entityManager->remove($class);
        $this->entityManager->flush();
    }

}