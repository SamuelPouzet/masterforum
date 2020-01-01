<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 27/12/2019
 * Time: 23:20
 */

namespace Application\Service;


use Application\Entity\Forum;
use Doctrine\ORM\EntityManager;

class ForumManager
{

    protected $entityManager;

    public function __construct(EntityManager $em)
    {
        $this->entityManager = $em;
    }

    public function add(array $data)
    {
        $entity = new Forum();
        $now = new \DateTime();

        $entity->setName($data['name']);
        $entity->setDateCreate($now->format(('Y-m-d H:i:s')));

        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

}