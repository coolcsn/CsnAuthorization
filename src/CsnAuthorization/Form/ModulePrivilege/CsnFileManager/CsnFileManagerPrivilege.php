<?php

namespace CsnAuthorization\Form\ModulePrivilege\CsnFileManager;

use Zend\Form\Fieldset;

class CsnFileManagerPrivilege extends Fieldset
{
    public function __construct()
    {
        parent::__construct('CsnFileManager');

        $this->setLabel('CsnFileManager');

        $this->add(array(
            'type' => 'CsnAuthorization\Form\ModulePrivilege\CsnFileManager\ControllerFieldset\IndexControllerFieldset',
            'options' => array(
                'use_as_base_fieldset' => false,
            ),
        ));
    }
}
