<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 01/01/2020
 * Time: 10:43
 */

namespace Application\Controller\Model;


use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;

abstract class BaseController extends AbstractActionController
{

    public function onDispatch(MvcEvent $e)
    {
        parent::onDispatch($e);
        $this->layout()->id_forum = $this->params()->fromRoute('id_forum', 0);;
    }
}