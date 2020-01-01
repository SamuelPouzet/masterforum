<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 27/12/2019
 * Time: 17:45
 */

namespace Application\Service;


use Application\Entity\Posts;
use Application\Entity\Subjects;
use Doctrine\ORM\EntityManager;

class PostManager
{
    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function add(array $data, Subjects $subject)
    {

        $now = new \DateTime();

        $entity = new Posts();
        $entity->setSubject($subject);
        $entity->setContent($data['content']);
        $entity->setDateCreate($now->format('Y-m-d H:i:s'));

        $this->entityManager->persist($entity);
        $this->entityManager->flush();

    }

}