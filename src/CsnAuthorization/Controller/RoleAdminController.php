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

use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

use CsnAuthorization\Form\RoleForm;
use CsnAuthorization\Form\RoleFilter;
use CsnAuthorization\Model\Privilege as PrivilegeModel;

use CsnUser\Entity\Role;


/**
 * Role Admin controller
 */
class RoleAdminController extends AbstractActionController
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
     * Index action
     *
     * Method to show the role list
     *
     * @return Zend\View\Model\ViewModel
     */
    public function indexAction()
    {
        $roles = $this->getEntityManager()->getRepository('CsnUser\Entity\Role')->findall();
        return new ViewModel(array('roles' => $roles));
    }    
    
    /**
     * Create action
     *
     * Method to create a new Role
     *
     * @return Zend\View\Model\ViewModel
     */
    public function createRoleAction()
    {
        $entityManager = $this->getEntityManager();
        $role = new Role;
        $form = new RoleForm;     
           
        $form->setAttributes(array(
            'action' => $this->url()->fromRoute('role-admin', array('action' => 'create-role')),
            'name' => 'create-role'
             ));        
        $form->get('submit')->setAttributes(array(
                'value' => $this->getTranslatorHelper()->translate('Create Role', 'csnauthorization'),
             ));
        $form->setHydrator(new DoctrineHydrator($entityManager));
        $form->bind($role);
    
        if($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost());
            $form->setInputFilter(new RoleFilter($entityManager));
            if($form->isValid()) {
                $role->setPrivilege(PrivilegeModel::createPrivilegeArray($form->getData()->getPrivilege(), $role));
                $entityManager->persist($role);
                $entityManager->flush();
                $this->flashMessenger()->addSuccessMessage($this->getTranslatorHelper()->translate('Role Created Successfully', 'csnauthorization'));
                return $this->redirect()->toRoute('role-admin');
            } else {
                $this->flashMessenger()->addErrorMessage($this->getTranslatorHelper()->translate('Something went wrong on Role creation', 'csnauthorization'));
                return $this->redirect()->toRoute('role-admin');
            }
        }

        $viewModel = new ViewModel(array(
            'form' => $form,
            'headerLabel' => $this->getTranslatorHelper()->translate('Create Role', 'csnauthorization'),
        ));
        $viewModel->setTemplate('csn-authorization/role-admin/role-form');
        return $viewModel;
    }
    
    /**
     * Edit action
     *
     * Method to update a Role
     *
     * @return Zend\View\Model\ViewModel
     */
    public function editRoleAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);

        if($id == 0) {
            $this->flashMessenger()->addErrorMessage($this->getTranslatorHelper()->translate('Role ID invalid', 'csnauthorization'));
            return $this->redirect()->toRoute('role-admin');
        }
        
        $entityManager = $this->getEntityManager();
        $role = $entityManager->getRepository('CsnUser\Entity\Role')->find($id);
        $form = new RoleForm;
        
        $form->setAttributes(array(
                'action' => $this->url()->fromRoute('role-admin', array('action' => 'edit-role', 'id' => $id)),
                'name' => 'edit-role'
             ));
        $form->get('submit')->setAttributes(array(
                'value' => $this->getTranslatorHelper()->translate('Edit Role', 'csnauthorization'),
             ));
        $form->setHydrator(new DoctrineHydrator($entityManager));
        $form->bind($role);

        PrivilegeModel::setFormCheckBoxes($role->getPrivilege(), $form);
        
        if($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost());
            $form->setInputFilter(new RoleFilter($entityManager));
            //@TODO Revisar si se puede quitar de la validacion al editar el duplicado de objetos de Doctrine!
            //$form->setValidationGroup('roleDescription', 'csrf');
            if($form->isValid()) {
                $role->setPrivilege(PrivilegeModel::createPrivilegeArray($form->getData()->getPrivilege(), $role));
                $entityManager->persist($role);
                $entityManager->flush();
                $this->flashMessenger()->addSuccessMessage($this->getTranslatorHelper()->translate('Role Updated Successfully', 'csnauthorization'));
                return $this->redirect()->toRoute('role-admin');
            } else {
                $this->flashMessenger()->addErrorMessage($this->getTranslatorHelper()->translate('Something went wrong on Role update', 'csnauthorization'));
                return $this->redirect()->toRoute('role-admin');
            }
        }  

        $viewModel = new ViewModel(array(
            'form' => $form,
            'headerLabel' => $this->getTranslatorHelper()->translate('Edit Role', 'csnauthorization'),
        ));
        $viewModel->setTemplate('csn-authorization/role-admin/role-form');
        return $viewModel;
    }

    /**
     * Delete action
     *
     * Method to delete an Role from his ID
     *
     * @return Zend\View\Model\ViewModel
     */
    public function deleteRoleAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);

        if ($id == 0) {
            $this->flashMessenger()->addErrorMessage($this->getTranslatorHelper()->translate('Role ID invalid', 'csnauthorization'));
            return $this->redirect()->toRoute('role-admin');
        }
           
        $entityManager = $this->getEntityManager();
        $role = $entityManager->getRepository('CsnUser\Entity\Role')->find($id);
        $entityManager->remove($role);
        $entityManager->flush();
        $this->flashMessenger()->addSuccessMessage($this->getTranslatorHelper()->translate('Role Deleted Successfully', 'csnauthorization'));

        return $this->redirect()->toRoute('role-admin');
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
}
