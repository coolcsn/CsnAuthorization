<?php
namespace CsnAuthorization\Form;

use Zend\Form\Form;

class RoleForm extends Form
{
    public function __construct()
    {
        parent::__construct();
        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'name',
            'attributes' => array(
                'type'  => 'text',
            ),
        ));

        $this->add(array(
            'name' => 'roleDescription',
            'attributes' => array(
                'type'  => 'text',
            ),
        ));
        
        $this->add(array(
            'type' => 'CsnAuthorization\Form\ModulePrivilege\PrivilegeFieldset',
            'options' => array(
                'use_as_base_fieldset' => false,
            ),
        ));

        $this->add(array(
            'name' => 'csrf',
            'type' => 'Zend\Form\Element\Csrf',
            'options' => array(
                'csrf_options' => array(
                    'timeout' => 3600,
                )
            )
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'class' => 'btn btn-success btn-lg',
            ),
        ));
    }
}
