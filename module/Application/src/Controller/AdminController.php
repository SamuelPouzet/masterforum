<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 27/12/2019
 * Time: 22:56
 */

namespace Application\Controller;


use Application\Entity\Forum;
use Application\Form\NewForumForm;
use Application\Service\ForumManager;
use Doctrine\ORM\EntityManager;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AdminController extends AbstractActionController
{

    protected $entityManager;
    protected $forumManager;

    public function __construct(EntityManager $em, ForumManager $fm)
    {
        $this->entityManager = $em;
        $this->forumManager = $fm;
    }

    public function listAction(){
        $forums = $this->entityManager->getRepository(Forum::class)->findAll();

        return new ViewModel([
            'forums'=>$forums,
        ]);
    }

    public function newAction()
    {
        $form = new NewForumForm();

        if($this->getRequest()->isPost()){
            $request = $this->params()->fromPost();
            $form->setData($request);

            if($form->isValid()){
                $data = $form->getData();

                $this->forumManager->add($data);
                //$this->redirect()->toRoute('communication');
            }
        }

        return new ViewModel([
            'form'=>$form,
        ]);
    }

}