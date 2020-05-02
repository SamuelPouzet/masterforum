<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 02/05/2020
 * Time: 10:57
 */

namespace Application\Controller\Factory;


use Application\Controller\LocalAdminController;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class LocalAdminControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new LocalAdminController();
    }

}