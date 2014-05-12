<?php

namespace CsnAuthorization\Form\ModulePrivilege;

use Zend\Form\Fieldset;

class PrivilegeFieldset extends Fieldset
{
    public function __construct()
    {
        parent::__construct('Privilege');

        $this->setLabel('Privilege');

        $this->add(array(
            'type' => 'CsnAuthorization\Form\ModulePrivilege\CsnUser\CsnUserPrivilege',
            'options' => array(
                'use_as_base_fieldset' => false,
            ),
        ));
        
        $this->add(array(
            'type' => 'CsnAuthorization\Form\ModulePrivilege\CsnAuthorization\CsnAuthorizationPrivilege',
            'options' => array(
                'use_as_base_fieldset' => false,
            ),
        ));
        
    }
}