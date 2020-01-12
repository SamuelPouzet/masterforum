<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 12/01/2020
 * Time: 15:31
 */

namespace Application\View\Helper\Factory;


use Application\View\Helper\BreadCrumbsHelper;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class BreadCrumbsHelperFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new BreadCrumbsHelper();
    }

}