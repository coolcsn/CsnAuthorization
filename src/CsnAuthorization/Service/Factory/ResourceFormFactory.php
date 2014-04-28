<?php
/**
 * CsnAuthorization - Coolcsn Zend Framework 2 User Module
 * 
 * @link https://github.com/coolcsn/CsnUser for the canonical source repository
 * @copyright Copyright (c) 2005-2013 LightSoft 2005 Ltd. Bulgaria
 * @license https://github.com/coolcsn/CsnUser/blob/master/LICENSE BSDLicense
 * @author Stoyan Cheresharov <stoyan@coolcsn.com>
 * @author Svetoslav Chonkov <svetoslav.chonkov@gmail.com>
 * @author Nikola Vasilev <niko7vasilev@gmail.com>
 * @author Stoyan Revov <st.revov@gmail.com>
 * @author Martin Briglia <martin@mgscreativa.com>
 */

namespace CsnAuthorization\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use DoctrineORMModule\Form\Annotation\AnnotationBuilder as DoctrineAnnotationBuilder;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use DoctrineModule\Validator\NoObjectExists as NoObjectExistsValidator;

use CsnAuthorization\Entity\Resource;

class ResourceFormFactory implements FactoryInterface
{
  
    /**
     * @var Zend\Form\Form
     */
    private $form;
    
    /**
     * @var ServiceLocatorInterface
     */
    private $serviceLocator;
    
    /**
     * @var Doctrine\ORM\EntityManager
     */
    protected $entityManager;
    
    /**
     * @var Zend\Mvc\I18n\Translator
     */
    protected $translatorHelper;
    
    /**
     * @var Zend\Mvc\Controller\Plugin\Url
     */
    protected $url;
    
  
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }
    
    /**
     * Create admin resource form
     *
     * Method to create the Doctrine ORM resource form for edit/create resources 
     *
     * @return Zend\Form\Form
     */
    public function createResourceForm($resourceEntity, $formName = 'CreateResource')
    {
        $entityManager = $this->getEntityManager();
        $builder = new DoctrineAnnotationBuilder($entityManager);
        $this->form = $builder->createForm($resourceEntity);
        $this->form->setHydrator(new DoctrineHydrator($entityManager));
        $this->form->setAttribute('method', 'post');
        
        switch($formName) {
          case 'CreateResource':
              $this->form->setAttributes(array(
                  'action' => $this->getUrlPlugin()->fromRoute('resource-admin', array('action' => 'create-resource')),
                  'name' => 'create-resource'
              ));
              
              $this->form->getInputFilter()->get('name')->getValidatorChain()->attach(
                      new NoObjectExistsValidator(array(
                          'object_repository' => $entityManager->getRepository('CsnAuthorization\Entity\Resource'),
                          'fields'            => array('name'),
                          'messages' => array(
                              'objectFound' => $this->getTranslatorHelper()->translate('This resource name is already taken'),
                          ),
                      ))
              );
              
              break;
              
          case 'EditResource':
              $this->form->setAttributes(array(
                  'name' => 'edit-resource'
              ));
              break;
        }
        

        $this->form->add(array(
            'name' => 'csrf',
            'type' => 'Zend\Form\Element\Csrf',
            'options' => array(
                'csrf_options' => array(
                    'timeout' => 600
                )
            )
        ));
         
        $this->form->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'type'  => 'submit',
            ),
        ));

        $this->form->bind($resourceEntity);
    
        return $this->form;
    }
    
    /**
     * get entityManager
     *
     * @return Doctrine\ORM\EntityManager
     */
    private function getEntityManager()
    {
        if(null === $this->entityManager) {
            $this->entityManager = $this->serviceLocator->get('doctrine.entitymanager.orm_default');
        }
    
        return $this->entityManager;
    }
    
    /**
     * get translatorHelper
     *
     * @return  Zend\Mvc\I18n\Translator
     */
    private function getTranslatorHelper()
    {
        if(null === $this->translatorHelper) {
            $this->translatorHelper = $this->serviceLocator->get('MvcTranslator');
        }
    
        return $this->translatorHelper;
    }
    
    /**
     * get urlPlugin
     *
     * @return  Zend\Mvc\Controller\Plugin\Url
     */
    private function getUrlPlugin()
    {
        if(null === $this->url) {
            $this->url = $this->serviceLocator->get('ControllerPluginManager')->get('url');
        }
    
        return $this->url;
    }
}
