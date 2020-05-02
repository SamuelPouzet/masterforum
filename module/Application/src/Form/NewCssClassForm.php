<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 01/01/2020
 * Time: 11:55
 */

namespace Application\Form;


use Zend\Form\Element\Csrf;
use Zend\Form\Element\Select;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\Form\Form;


class NewCssClassForm extends Form
{
    public function __construct($scenario = 'create', $entityManager = null, $role = null)
    {
        // Define form name
        parent::__construct('newforum-form');

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
                'id' => 'class-name'
            ],
            'options' => [
                'label' => 'Nom',
            ],
        ]);

        $this->add([
            'type'  => Select::class,
            'name' => 'type',
            'attributes' => [
                'id' => 'class-type',
            ],
            'options' => [
                'label' => 'Type',
                'value_options' => [
                    '0' => 'Balise HTML',
                    '1' => 'Classe',
                    '2' => 'Id',
                ],
            ],
        ]);

        // Add the Submit button
        $this->add([
            'type'  => Submit::class,
            'name' => 'submit-class',
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