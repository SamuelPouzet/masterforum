<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 12/01/2020
 * Time: 14:21
 */

namespace Application\Service;


use Doctrine\ORM\EntityManager;
use User\Service\RbacManager;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Validator\Authentication;
use Zend\View\Helper\Url;

/**
 * Class NavManager
 * @package Application\Service
 */
class NavManager
{

    /**
     * Url view helper.
     * @var Zend\View\Helper\Url
     */
    private $urlHelper;

    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * Auth service.
     * @var Zend\Authentication\Authentication
     */
    private $authService;
    /**
     * RBAC manager.
     * @var User\Service\RbacManager
     */
    private $rbacManager;

    public function __construct(EntityManager $em, Url $url, AuthenticationService $authentication, RbacManager $rbacMananger)
    {
        $this->entityManager = $em;
        $this->urlHelper = $url;
        $this->authService = $authentication;
        $this->rbacManager = $rbacMananger;
    }

    public function getMenuItems()
    {

        $url = $this->urlHelper;

        $items[] = [
            'id' => 'home',
            'label' => 'Index',
            'link' => $url('forums/forum', ["id_forum"=>1]),
        ];

        $items[] = [
            'id' => 'logout',
            'label' => 'Sign out',
            'link' => $url('logout'),
        ];

        $items[] = [
            'id' => 'profile',
            'label' => $this->authService->getIdentity(),
            'dropdown' => [
                [
                    'id' => 'logout',
                    'label' => 'Déconnexion',
                    'link' =>  $url('logout'),
                ],
            ]
        ];


        return $items;

    }

}