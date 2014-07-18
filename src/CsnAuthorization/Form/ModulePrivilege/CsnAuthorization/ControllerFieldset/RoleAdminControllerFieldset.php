<?php

namespace CsnAuthorization\Form\ModulePrivilege\CsnAuthorization\ControllerFieldset;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

class RoleAdminControllerFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct()
    {
        parent::__construct('RoleAdmin');

        $this->setLabel('RoleAdmin');
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'index',
            'options' => array(
                'label' => 'List Roles',
                'use_hidden_element' => true,
                'checked_value' => '1',
                'unchecked_value' => '0'
            ),
            'attributes' => array(
                'title' => 'Grant access to admin role list',
            ),
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'create-role',
            'options' => array(
                'label' => 'Create Role',
                'use_hidden_element' => true,
                'checked_value' => '1',
                'unchecked_value' => '0'
            ),
            'attributes' => array(
                'title' => 'Allow create new role',
            ),
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'edit-role',
            'options' => array(
                'label' => 'Edit Role',
                'use_hidden_element' => true,
                'checked_value' => '1',
                'unchecked_value' => '0'
            ),
            'attributes' => array(
                'title' => 'Allow edit existing role',
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'delete-role',
            'options' => array(
                'label' => 'Delete Role',
                'use_hidden_element' => true,
                'checked_value' => '1',
                'unchecked_value' => '0'
            ),
            'attributes' => array(
                'title' => 'Allow delete role',
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
