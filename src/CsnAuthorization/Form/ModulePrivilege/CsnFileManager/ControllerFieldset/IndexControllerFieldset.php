<?php

namespace CsnAuthorization\Form\ModulePrivilege\CsnFileManager\ControllerFieldset;

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
                'label' => 'File List',
                'use_hidden_element' => true,
                'checked_value' => '1',
                'unchecked_value' => '0'
            ), 
            'attributes' => array(
                'title' => 'Grant access to file list',
            ),
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'upload',
            'options' => array(
                'label' => 'Upload File',
                'use_hidden_element' => true,
                'checked_value' => '1',
                'unchecked_value' => '0'
            ),
            'attributes' => array(
                'title' => 'Grant access to upload page',
            ),
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'download',
            'options' => array(
                'label' => 'Download File',
                'use_hidden_element' => true,
                'checked_value' => '1',
                'unchecked_value' => '0'
            ),
            'attributes' => array(
                'title' => 'Grant access to download file',
            ),
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'delete',
            'options' => array(
                'label' => 'Delete File',
                'use_hidden_element' => true,
                'checked_value' => '1',
                'unchecked_value' => '0'
            ),
            'attributes' => array(
                'title' => 'Grant access to delete file',
            ),
        ));  

        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'view',
            'options' => array(
                'label' => 'View File',
                'use_hidden_element' => true,
                'checked_value' => '1',
                'unchecked_value' => '0'
            ),
            'attributes' => array(
                'title' => 'Grant access to view file',
            ),
        ));   

        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'get-image',
            'options' => array(
                'label' => 'Get Image',
                'use_hidden_element' => true,
                'checked_value' => '1',
                'unchecked_value' => '0'
            ),
            'attributes' => array(
                'title' => 'Grant access to get image',
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
