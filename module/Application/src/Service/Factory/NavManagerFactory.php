<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 12/01/2020
 * Time: 14:21
 */

namespace Application\Service\Factory;


use Application\Service\NavManager;
use Interop\Container\ContainerInterface;
use User\Service\RbacManager;
use Zend\ServiceManager\Factory\FactoryInterface;

class NavManagerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entitymanager = $container->get('doctrine.entitymanager.orm_default');
        $viewHelperManager = $container->get('ViewHelperManager');
        $urlHelper = $viewHelperManager->get('url');
        $authService = $container->get(\Zend\Authentication\AuthenticationService::class);
        $rbacManager = $container->get(RbacManager::class);

        return new NavManager($entitymanager, $urlHelper, $authService, $rbacManager);
    }

}