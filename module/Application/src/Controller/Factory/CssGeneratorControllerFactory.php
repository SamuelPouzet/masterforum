<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 28/12/2019
 * Time: 12:35
 */

namespace Application\Controller\Factory;


use Application\Controller\CssGeneratorController;
use Application\Service\CssManager;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class CssGeneratorControllerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $cssManager = $container->get(CssManager::class);

        return new CssGeneratorController($entityManager, $cssManager);
    }

}