<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 27/12/2019
 * Time: 19:21
 */

namespace Application\Controller\Factory;


use Application\Controller\AdminController;
use Application\Controller\IndexController;
use Application\Service\ForumManager;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class AdminControllerFactory implements  FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $forumManager = $container->get(ForumManager::class);

        return new AdminController($entityManager, $forumManager);
    }


}