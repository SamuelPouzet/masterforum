<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 28/12/2019
 * Time: 12:35
 */

namespace Application\Controller;


use Application\Entity\CssClass;
use Doctrine\ORM\EntityManager;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CssGeneratorController extends AbstractActionController
{

    protected $entityManager;

    public function __construct(EntityManager $em)
    {
        $this->entityManager = $em;
    }

    public function showAction()
    {
        $id_forum = $this->params()->fromRoute('id_forum', 0);

        $classes = $this->entityManager->getRepository(CssClass::class)->findBy([
            "forum_id"=>$id_forum,
        ]);

        $viewModel = new ViewModel();
        $viewModel->setVariables([
            "classes"=>$classes,
        ])
            ->setTerminal(true);

        return $viewModel;
    }

}