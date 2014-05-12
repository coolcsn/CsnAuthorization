<?php

namespace CsnAuthorization\Form\ModulePrivilege\CsnAuthorization;

use Zend\Form\Fieldset;

class CsnAuthorizationPrivilege extends Fieldset
{
    public function __construct()
    {
        parent::__construct('CsnAuthorization');

        $this->setLabel('CsnAuthorization');

        $this->add(array(
            'type' => 'CsnAuthorization\Form\ModulePrivilege\CsnAuthorization\ControllerFieldset\RoleAdminControllerFieldset',
            'options' => array(
                'use_as_base_fieldset' => false,
            ),
        ));
    }
}
