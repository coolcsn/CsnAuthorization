<?php

namespace CsnAuthorization\Form\ModulePrivilege\CsnUser\ControllerFieldset;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

class RegistrationControllerFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct()
    {
        parent::__construct('Registration');

        $this->setLabel('Registration');

        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'index',
            'options' => array(
                'label' => 'Register',
                'use_hidden_element' => true,
                'checked_value' => '1',
                'unchecked_value' => '0'
            ),
            'attributes' => array(
                'title' => 'Grant access to registration page',
            ),
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'edit-profile',
            'options' => array(
                'label' => 'Edit Profile',
                'use_hidden_element' => true,
                'checked_value' => '1',
                'unchecked_value' => '0'
            ),
            'attributes' => array(
                'title' => 'Grant access to edit own profile',
            ),
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'change-password',
            'options' => array(
                'label' => 'Change Password',
                'use_hidden_element' => true,
                'checked_value' => '1',
                'unchecked_value' => '0'
            ),
            'attributes' => array(
                'title' => 'Allow user to change password',
            ),
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'reset-password',
            'options' => array(
                'label' => 'Reset Password',
                'use_hidden_element' => true,
                'checked_value' => '1',
                'unchecked_value' => '0'
            ),
            'attributes' => array(
                'title' => 'Allow user to reset password',
            ),
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'change-email',
            'options' => array(
                'label' => 'Change Email',
                'use_hidden_element' => true,
                'checked_value' => '1',
                'unchecked_value' => '0'
            ),
            'attributes' => array(
                'title' => 'Allow user to change email',
            ),
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'change-security-question',
            'options' => array(
                'label' => 'Change Security Question',
                'use_hidden_element' => true,
                'checked_value' => '1',
                'unchecked_value' => '0'
            ),
            'attributes' => array(
                'title' => 'Allow user to change security question',
            ),
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'confirm-email',
            'attributes' => array(
                'value' => '1'
            )
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'confirm-email-change-password',
            'attributes' => array(
                'value' => '1'
            )
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
