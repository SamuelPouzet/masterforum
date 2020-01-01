<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 27/12/2019
 * Time: 16:51
 */

namespace Application\Controller;

use Application\Controller\Model\BaseController;
use Application\Entity\Topics;
use Application\Form\NewSubjectForm;
use Application\Service\SubjectManager;
use Doctrine\ORM\EntityManager;
use Zend\View\Model\ViewModel;

class TopicController extends BaseController
{

    protected $entityManager;

    protected $subjectManager;

    public function __construct(EntityManager $em, SubjectManager $sm)
    {
        $this->entityManager = $em;
        $this->subjectManager = $sm;
    }

    public function listAction()
    {
        $id_forum = $this->params()->fromRoute('id_forum', 0);

        $id_topic = $this->params()->fromRoute('id', 0);

        $topic = $this->entityManager->getRepository(Topics::class)->find($id_topic);

        if(!$topic || $topic->getForum()->getId() != $id_forum){
            throw new \Exception('Forum non trouvé');
        }

        $form = new NewSubjectForm();

        if($this->getRequest()->isPost()){
            $request = $this->params()->fromPost();
            $form->setData($request);

            if($form->isValid()){
                $data = $form->getData();

                $this->subjectManager->add($data, $topic );
                //$this->redirect()->toRoute('communication');
            }
        }

        return new ViewModel([
            'topic' => $topic,
            'form' => $form,
        ]);
    }
}