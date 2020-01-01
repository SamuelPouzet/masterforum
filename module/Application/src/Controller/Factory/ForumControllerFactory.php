<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 27/12/2019
 * Time: 16:05
 */

namespace Application\Controller\Factory;


use Application\Controller\ForumController;
use Application\Service\CssManager;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class ForumControllerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {

        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $cssManager = $container->get(CssManager::class);
        return new ForumController($entityManager, $cssManager);
    }

}