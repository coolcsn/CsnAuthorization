<?php

namespace CsnAuthorization\Form\ModulePrivilege\CsnCms\ControllerFieldset;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

class IndexControllerFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct()
    {
        parent::__construct('Index');

        $this->setLabel('Index');

        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'index',
            'options' => array(
                'label' => 'Home',
                'use_hidden_element' => true,
                'checked_value' => '1',
                'unchecked_value' => '0'
            ), 
            'attributes' => array(
                'title' => 'Grant access to module homepage',
            ),
        ));
    }
    
    public function getInputFilterSpecification()
    {
        $filterArray = array();
        foreach($this->getElements() as $element) {
            $filterArray[] = array(
                'name' => $element->getName(),
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'Regex',
                        'options' => array(
                            'pattern' => '/^[0-1]{1}$/',
                        ),
                    ),
                ),
            );
        }
        return $filterArray;
    }
}
