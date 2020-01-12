<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 12/01/2020
 * Time: 14:18
 */

namespace Application\View\Helper\Factory;

use Application\View\Helper\MenuHelper;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Application\View\Helper\Menu;
use Application\Service\NavManager;

/**
 * This is the factory for Menu view helper. Its purpose is to instantiate the
 * helper and init menu items.
 */
class MenuHelperFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $navManager = $container->get(NavManager::class);

        // Get menu items.
        $items = $navManager->getMenuItems();
        // Instantiate the helper.
        return new MenuHelper($items);
    }
}