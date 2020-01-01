<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 27/12/2019
 * Time: 16:51
 */

namespace Application\Controller;


use Application\Controller\Model\BaseController;
use Application\Entity\Forum;
use Application\Entity\Subjects;
use Application\Form\NewPostForm;
use Application\Service\PostManager;
use Doctrine\ORM\EntityManager;
use Zend\View\Model\ViewModel;

class SubjectController extends BaseController
{

    protected $entityManager;

    protected $postManager;

    public function __construct(EntityManager $em, PostManager $pm)
    {
        $this->entityManager = $em;
        $this->postManager = $pm;
    }

    public function listAction()
    {
        $id_forum = $this->params()->fromRoute('id_forum', 0);

        $id_subject = $this->params()->fromRoute('id', 0);

        $subject = $this->entityManager->getRepository(Subjects::class)->find($id_subject);

        if(!$subject || $subject->getTopic()->getForum()->getId() != $id_forum){
            throw new \Exception('Forum non trouvé');
        }

        $form = new NewPostForm();

        if($this->getRequest()->isPost()){
            $request = $this->params()->fromPost();
            $form->setData($request);

            if($form->isValid()){
                $data = $form->getData();

                $this->postManager->add($data, $subject);
                //$this->redirect()->toRoute('communication');
            }
        }

        return new ViewModel([
            'subject' => $subject,
            'form' => $form,
        ]);
    }
}