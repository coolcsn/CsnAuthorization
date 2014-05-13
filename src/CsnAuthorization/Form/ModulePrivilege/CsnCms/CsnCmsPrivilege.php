<?php

namespace CsnAuthorization\Form\ModulePrivilege\CsnCms;

use Zend\Form\Fieldset;

class CsnCmsPrivilege extends Fieldset
{
    public function __construct()
    {
        parent::__construct('CsnCms');

        $this->setLabel('CsnCms');

        $this->add(array(
            'type' => 'CsnAuthorization\Form\ModulePrivilege\CsnCms\ControllerFieldset\IndexControllerFieldset',
            'options' => array(
                'use_as_base_fieldset' => false,
            ),
        ));

        $this->add(array(
            'type' => 'CsnAuthorization\Form\ModulePrivilege\CsnCms\ControllerFieldset\ArticleControllerFieldset',
            'options' => array(
                'use_as_base_fieldset' => false,
            ),
        ));

        $this->add(array(
            'type' => 'CsnAuthorization\Form\ModulePrivilege\CsnCms\ControllerFieldset\CategoryControllerFieldset',
            'options' => array(
                'use_as_base_fieldset' => false,
            ),
        ));
        
        $this->add(array(
            'type' => 'CsnAuthorization\Form\ModulePrivilege\CsnCms\ControllerFieldset\CommentControllerFieldset',
            'options' => array(
                'use_as_base_fieldset' => false,
            ),
        ));
    
            $this->add(array(
            'type' => 'CsnAuthorization\Form\ModulePrivilege\CsnCms\ControllerFieldset\TranslationControllerFieldset',
            'options' => array(
                'use_as_base_fieldset' => false,
            ),
        ));
    }
}
