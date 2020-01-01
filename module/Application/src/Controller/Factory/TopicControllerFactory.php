<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 27/12/2019
 * Time: 16:05
 */

namespace Application\Controller\Factory;


use Application\Controller\TopicController;
use Application\Service\SubjectManager;
use Application\Service\TopicManager;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class TopicControllerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {

        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $subjectManager = $container->get(SubjectManager::class);
        return new TopicController($entityManager, $subjectManager);
    }

}