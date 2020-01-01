<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 01/01/2020
 * Time: 13:23
 */

namespace Application\Form;


use Zend\Form\Element\Csrf;
use Zend\Form\Element\Number;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\Form\Form;

class NewCssAttributeForm extends Form
{
    public function __construct($scenario = 'create', $entityManager = null, $role = null)
    {
        // Define form name
        parent::__construct('newCssAttribute-form');

        // Set POST method for this form
        $this->setAttribute('method', 'post');

        // (Optionally) set action for this form
        $this->setAttribute('action', '');
        //$this->setAttribute('enctype', 'multipart/form-data');

        $this->addElements();
        $this->addInputFilters();
    }

    protected function addElements()
    {
        $this->add([
            'type'  => Text::class,
            'name' => 'name',
            'attributes' => [
                'id' => 'name'
            ],
            'options' => [
                'label' => 'Nom',
            ],
        ]);

        $this->add([
            'type'  => Text::class,
            'name' => 'attribute',
            'attributes' => [
                'id' => 'attribute'
            ],
            'options' => [
                'label' => 'Attribut',
            ],
        ]);

        $this->add([
            'type'  => Text::class,
            'name' => 'addendum',
            'attributes' => [
                'id' => 'addendum'
            ],
            'options' => [
                'label' => 'Addendum',
            ],
        ]);


        $this->add([
            'type'  => Number::class,
            'name' => 'class_id',
            'attributes' => [
                'id' => 'class_id'
            ],
            'options' => [
                'label' => 'class_id',
            ],
        ]);


        // Add the Submit button
        $this->add([
            'type'  => Submit::class,
            'name' => 'submit',
            'attributes' => [
                'value' => 'Enregistrer',
                'id' => 'submit',
            ],
        ]);

        $this->add([
            'type' => Csrf::class,
            'name' => 'csrf',
            'options' => [
                'csrf_options' => [
                    'timeout' => 600
                ]
            ]
        ]);
    }

    protected function addInputFilters()
    {

    }
}