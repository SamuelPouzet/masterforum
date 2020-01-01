<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 27/12/2019
 * Time: 16:04
 */

namespace Application\Controller;


use Application\Controller\Model\BaseController;
use Application\Entity\CssClass;
use Application\Entity\Forum;
use Application\Form\NewCssAttributeForm;
use Application\Form\NewCssClassForm;
use Application\Service\CssManager;
use Doctrine\ORM\EntityManager;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;
use Zend\View\Strategy\JsonStrategy;

class ForumController extends BaseController
{

    protected $entityManager;

    protected $forum;

    protected $cssManager;

    public function __construct(EntityManager $em, CssManager $cm)
    {
        $this->entityManager = $em;
        $this->cssManager = $cm;
    }

    public function listAction()
    {
        $id_forum = $this->params()->fromRoute('id_forum', 0);

        $forum = $this->entityManager->getRepository(Forum::class)->find($id_forum);
//\Doctrine\Common\Util\Debug::dump($forum);die;
        if(!$forum){
            throw new \Exception('forum non trouvé');
        }

        return new ViewModel([
            'forum' => $forum,
        ]);

    }

    public function adminAction()
    {
        $id_forum = $this->params()->fromRoute('id_forum', 0);

        $forum = $this->entityManager->getRepository(Forum::class)->find($id_forum);

        if(!$forum){
            throw new \Exception('forum non trouvé');
        }

        $classes = $this->entityManager->getRepository(CssClass::class)->findBy([
            "forum_id"=>$id_forum,
        ]);

        $form = new NewCssClassForm();

        if($this->getRequest()->isPost()){
            $request = $this->params()->fromPost();
            $form->setData($request);

            if($form->isValid()){
                $data = $form->getData();

                $this->cssManager->addClass($data, $forum);
                //$this->redirect()->toRoute('communication');
            }
        }

        return new ViewModel([
            'forum' => $forum,
            'classes' => $classes,
            'form'=>$form,
        ]);
    }

    public function ajaxNewCssAttributeAction()
    {
        $form = new NewCssAttributeForm();

        if($this->getRequest()->isPost()){
            $request = $this->params()->fromPost();
            $form->setData($request);
            if($form->isValid()){
                $data = $form->getData();

                $this->cssManager->newAttribute($data);
            }
        }

        return new JsonModel([]);
    }

    public function ajaxUpdateCssAttributeAction()
    {
        $form = new NewCssAttributeForm('update');

        if($this->getRequest()->isPost()){
            $request = $this->params()->fromPost();
            $form->setData($request);
            //die(var_dump($form->isValid()));
            if($form->isValid()){
                $data = $form->getData();

                $this->cssManager->updAttribute($data);
            }
        }

        return new JsonModel([]);
    }

    public function ajaxDeleteCssAttributeAction()
    {

        if($this->getRequest()->isPost()){
            $request = $this->params()->fromPost();

            $this->cssManager->deleteAttribute($request);
            }

        return new JsonModel([]);
    }


}