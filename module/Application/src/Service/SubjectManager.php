<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 27/12/2019
 * Time: 17:45
 */

namespace Application\Service;


use Application\Entity\Forum;
use Application\Entity\Subjects;
use Application\Entity\Topics;
use Doctrine\ORM\EntityManager;

class SubjectManager
{
    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function add(array $data, Topics $topic)
    {

        $now = new \DateTime();

        $entity = new Subjects();
        $entity->setTopic($topic);
        $entity->setName($data['name']);
        $entity->setDateCreate($now->format('Y-m-d H:i:s'));

        $this->entityManager->persist($entity);
        $this->entityManager->flush();

    }

}