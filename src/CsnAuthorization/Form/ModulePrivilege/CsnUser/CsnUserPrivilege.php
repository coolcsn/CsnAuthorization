<?php

namespace CsnAuthorization\Form\ModulePrivilege\CsnUser;

use Zend\Form\Fieldset;

class CsnUserPrivilege extends Fieldset
{
    public function __construct()
    {
        parent::__construct('CsnUser');

        $this->setLabel('CsnUser');

        $this->add(array(
            'type' => 'CsnAuthorization\Form\ModulePrivilege\CsnUser\ControllerFieldset\IndexControllerFieldset',
            'options' => array(
                'use_as_base_fieldset' => false,
            ),
        ));

        $this->add(array(
            'type' => 'CsnAuthorization\Form\ModulePrivilege\CsnUser\ControllerFieldset\RegistrationControllerFieldset',
            'options' => array(
                'use_as_base_fieldset' => false,
            ),
        ));

        $this->add(array(
            'type' => 'CsnAuthorization\Form\ModulePrivilege\CsnUser\ControllerFieldset\AdminControllerFieldset',
            'options' => array(
                'use_as_base_fieldset' => false,
            ),
        ));
        
    }
}
