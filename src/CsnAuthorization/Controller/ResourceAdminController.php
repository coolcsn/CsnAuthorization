<?php
/**
 * CsnAuthorization - Coolcsn Zend Framework 2 Authorization Module
 * 
 * @link https://github.com/coolcsn/CsnAuthorization for the canonical source repository
 * @copyright Copyright (c) 2005-2013 LightSoft 2005 Ltd. Bulgaria
 * @license https://github.com/coolcsn/CsnAuthorization/blob/master/LICENSE BSDLicense
 * @author Stoyan Cheresharov <stoyan@coolcsn.com>
 * @author Stoyan Revov <st.revov@gmail.com>
 * @author Martin Briglia <martin@mgscreativa.com>
 */

namespace CsnAuthorization\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use CsnAuthorization\Entity\Resource;

/**
 * Resource Admin controller
 */
class ResourceAdminController extends AbstractActionController
{
    /**
     * @var Doctrine\ORM\EntityManager
     */
    protected $entityManager;
    
    /**
     * @var Zend\Mvc\I18n\Translator
     */
    protected $translatorHelper;
    
    /**
     * @var Zend\Form\Form
     */
    protected $resourceFormHelper;
    
    /**
     * Index action
     *
     * Method to show resource list
     *
     * @return Zend\View\Model\ViewModel
     */
    public function indexAction()
    {
        if(!$this->identity()) {
            $redirect_route = $config['acl']['redirect_route'];
            $url = $event->getRouter()->assemble($redirect_route['params'], $redirect_route['options']);
            $this->redirect()->toUrl($url);
        }
      
        $resources = $this->getEntityManager()->getRepository('CsnAuthorization\Entity\Resource')->findall();
        return new ViewModel(array('resources' => $resources));
    }    
    
    /**
     * Create resource action
     *
     * Method to create a resource
     *
     * @return Zend\View\Model\ViewModel
     */
    public function createResourceAction()
    {
        if(!$this->identity()) {
            $redirect_route = $config['acl']['redirect_route'];
            $url = $event->getRouter()->assemble($redirect_route['params'], $redirect_route['options']);
            $this->redirect()->toUrl($url);
        }
      
        $resource = new Resource;
        
        $form = $this->getResourceFormHelper()->createResourceForm($resource, 'CreateResource');
        if($this->getRequest()->isPost()) {
            $form->setValidationGroup('name', 'description', 'csrf');
            $form->setData($this->getRequest()->getPost());
            if ($form->isValid()) {
                $entityManager = $this->getEntityManager();
                $entityManager->persist($resource);
                $entityManager->flush();
                $this->flashMessenger()->addSuccessMessage($this->getTranslatorHelper()->translate('Resource created Successfully'));
                return $this->redirect()->toRoute('resource-admin');                                        
            }
        }
                
        $viewModel = new ViewModel(array('form' => $form));
        $viewModel->setTemplate('csn-authorization/resource-admin/new-resource-form');
        return $viewModel;
    }

    /**
     * Edit resource action
     *
     * Method to update a resource
     *
     * @return Zend\View\Model\ViewModel
     */
    public function editResourceAction()
    {
        if(!$this->identity()) {
            $redirect_route = $config['acl']['redirect_route'];
            $url = $event->getRouter()->assemble($redirect_route['params'], $redirect_route['options']);
            $this->redirect()->toUrl($url);
        }
      
        $id = (int) $this->params()->fromRoute('id', 0);

        if ($id == 0) {
            $this->flashMessenger()->addErrorMessage($this->getTranslatorHelper()->translate('Resource ID invalid'));
            return $this->redirect()->toRoute('resource-admin');
        }
        
        $entityManager = $this->getEntityManager();
        $resource = $entityManager->getRepository('CsnAuthorization\Entity\Resource')->find($id);
        
        $form = $this->getResourceFormHelper()->createResourceForm($resource, 'EditResource');
        
        $form->setAttributes(array(
            'action' => $this->url()->fromRoute('resource-admin', array('action' => 'edit-resource', 'id' => $id)),
        ));

        if ($this->getRequest()->isPost()) {
            $form->setValidationGroup('description', 'csrf');
            $form->setData($this->getRequest()->getPost());
            if ($form->isValid()) {
                $entityManager->persist($resource);
                $entityManager->flush();
                $this->flashMessenger()->addSuccessMessage($this->getTranslatorHelper()->translate('Resource Updated Successfully'));
                return $this->redirect()->toRoute('resource-admin');
            }
        }  
       
        $viewModel = new ViewModel(array(
            'form' => $form,
            'resource' => $resource->getName(),
        ));
        $viewModel->setTemplate('csn-authorization/resource-admin/edit-resource-form');
        return $viewModel;
    }

    /**
     * Delete resource action
     *
     * Method to delete a resource from his ID
     *
     * @return Zend\View\Model\ViewModel
     */
    public function deleteResourceAction()
    {
        if(!$this->identity()) {
            $redirect_route = $config['acl']['redirect_route'];
            $url = $event->getRouter()->assemble($redirect_route['params'], $redirect_route['options']);
            $this->redirect()->toUrl($url);
        }
      
        $id = (int) $this->params()->fromRoute('id', 0);

        if ($id == 0) {
            $this->flashMessenger()->addErrorMessage($this->getTranslatorHelper()->translate('Resource ID invalid'));
            return $this->redirect()->toRoute('resource-admin');
        }
           
        $entityManager = $this->getEntityManager();
        $resource = $entityManager->getRepository('CsnAuthorization\Entity\Resource')->find($id);
        $entityManager->remove($resource);
        $entityManager->flush();
        $this->flashMessenger()->addSuccessMessage($this->getTranslatorHelper()->translate('Resource Deleted Successfully'));


        return $this->redirect()->toRoute('resource-admin');
    }

    /**
     * get entityManager
     *
     * @return EntityManager
     */
    private function getEntityManager()
    {
        if (null === $this->entityManager) {
            $this->entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
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
        if (null === $this->translatorHelper) {
           $this->translatorHelper = $this->getServiceLocator()->get('MvcTranslator');
        }
      
        return $this->translatorHelper;
    }
    
    /**
     * get resourceFormHelper
     *
     * @return  Zend\Form\Form
     */
    private function getResourceFormHelper()
    {
        if (null === $this->resourceFormHelper) {
           $this->resourceFormHelper = $this->getServiceLocator()->get('csnauthorization_resource_form');
        }
      
        return $this->resourceFormHelper;
    }
}