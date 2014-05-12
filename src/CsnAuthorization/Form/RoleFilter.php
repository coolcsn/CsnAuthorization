<?php
namespace CsnAuthorization\Form;

use Zend\InputFilter\InputFilter;

class RoleFilter extends InputFilter
{
    public function __construct($entityManager)
    {
        $this->add(array(
            'name' => 'name',
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min' => 3,
                        'max' => 30,
                    ),
                ),
                array(
                    'name' => 'Regex',
                    'options' => array(
                        'pattern' => '/^[ña-zÑA-Z][ña-zÑA-Z0-9\ \_\-]+$/',
                    ),
                ),
               /* array(
                    'name' => 'DoctrineModule\Validator\NoObjectExists',
                    'options' => array(
                        'object_repository' => $entityManager->getRepository('CsnUser\Entity\Role'),
                        'fields' => 'name'
                    ),
                ),*/
            ),
        ));

        $this->add(array(
            'name' => 'roleDescription',
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 100,
                    ),
                ),
            ),
        ));
    }
}
