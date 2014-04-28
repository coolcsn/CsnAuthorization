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
     * @var Zend\Form\Form
     */
    protected $roleFormHelper;
    
    /**
     * Index action
     *
     * Method to show a role list
     *
     * @return Zend\View\Model\ViewModel
     */
    public function indexAction()
    {
        if(!$this->identity()) {
            $redirect_route = $config['acl']['redirect_route'];
            if(!empty($redirect_route)) {
                $url = $event->getRouter()->assemble($redirect_route['params'], $redirect_route['options']);
                $this->redirect()->toUrl($url);
                /*$response->setHeaders($response->getHeaders()->addHeaderLine('Location', $url));
                $response->setStatusCode(302);
                $response->sendHeaders();
                exit();*/
            } else {
                $response->setStatusCode(403);
                $response->setContent('
                    <html>
                        <head>
                            <title>403 Forbidden</title>
                        </head>
                        <body>
                            <h1>403 Forbidden</h1>
                        </body>
                    </html>'
                );
                return $response;
            }
        }
      
        $roles = $this->getEntityManager()->getRepository('CsnUser\Entity\Role')->findall();
        return new ViewModel(array('roles' => $roles));
    }    
    
    /**
     * Create action
     *
     * Method to create an user
     *
     * @return Zend\View\Model\ViewModel
     */
    /*public function createUserAction()
    {
        if(!$this->identity()) {
          return $this->redirect()->toRoute($this->getOptions()->getLoginRedirectRoute());
        }
      
        try {
            $user = new User;
            
            $form = $this->getRoleFormHelper()->createUserForm($user, 'CreateUser');
            $request = $this->getRequest();
            if ($request->isPost()) {
                $form->setValidationGroup('username', 'email', 'firstName', 'lastName', 'password', 'passwordVerify', 'language', 'state', 'role', 'question', 'answer', 'csrf');
                $form->setData($request->getPost());
                if ($form->isValid()) {
                    $entityManager = $this->getEntityManager();
                    $user->setEmailConfirmed(false);
                    $user->setRegistrationDate(new \DateTime());
                    $user->setRegistrationToken(md5(uniqid(mt_rand(), true)));
                    $user->setPassword(UserCredentialsService::encryptPassword($user->getPassword()));
                    $entityManager->persist($user);
                    $entityManager->flush();
                    $this->flashMessenger()->addSuccessMessage($this->getTranslatorHelper()->translate('User created Successfully'));
                    return $this->redirect()->toRoute('user-admin');                                        
                }
            }        
        }
        catch (\Exception $e) {
            return $this->getServiceLocator()->get('csnuser_error_view')->createErrorView(
                $this->getTranslatorHelper()->translate('Something went wrong during user creation! Please, try again later.'),
                $e,
                $this->getOptions()->getDisplayExceptions(),
                false
            );
        }
        
        $viewModel = new ViewModel(array('form' => $form));
        $viewModel->setTemplate('csn-user/admin/new-user-form');
        return $viewModel;
    }*/

    /**
     * Edit action
     *
     * Method to update an user
     *
     * @return Zend\View\Model\ViewModel
     */
    /*public function editUserAction()
    {
        if(!$this->identity()) {
          return $this->redirect()->toRoute($this->getOptions()->getLoginRedirectRoute());
        }
      
        try {
            $id = (int) $this->params()->fromRoute('id', 0);
    
            if ($id == 0) {
                $this->flashMessenger()->addErrorMessage($this->getTranslatorHelper()->translate('User ID invalid'));
                return $this->redirect()->toRoute('user-admin');
            }
            
            $entityManager = $this->getEntityManager();
            $user = $entityManager->getRepository('CsnUser\Entity\User')->find($id);
            
            $form = $this->getRoleFormHelper()->createUserForm($user, 'EditUser');
            
            $form->setAttributes(array(
                'action' => $this->url()->fromRoute('user-admin', array('action' => 'edit-user', 'id' => $id)),
            ));
              	
            $request = $this->getRequest();
            if ($request->isPost()) {
                $form->setValidationGroup('username', 'email', 'firstName', 'lastName', 'language', 'state', 'role', 'question', 'answer', 'csrf');
                $form->setData($request->getPost());
                if ($form->isValid()) {
                    $entityManager->persist($user);
                    $entityManager->flush();
                    $this->flashMessenger()->addSuccessMessage($this->getTranslatorHelper()->translate('User Updated Successfully'));
                    return $this->redirect()->toRoute('user-admin');
                }
            }  
        }      
        catch (\Exception $e) {
            return $this->getServiceLocator()->get('csnuser_error_view')->createErrorView(
                $this->getTranslatorHelper()->translate('Something went wrong during update user process! Please, try again later.'),
                $e,
                $this->getOptions()->getDisplayExceptions(),
                false
            );
        }
        
        $viewModel = new ViewModel(array(
            'form' => $form,
            'headerLabel' => $this->getTranslatorHelper()->translate('Edit User').' - '.$user->getDisplayName(),
        ));
        $viewModel->setTemplate('csn-user/admin/edit-user-form');
        return $viewModel;
    }*/

    /**
     * Delete action
     *
     * Method to delete an user from his ID
     *
     * @return Zend\View\Model\ViewModel
     */
    /*public function deleteUserAction()
    {
        if(!$this->identity()) {
          return $this->redirect()->toRoute($this->getOptions()->getLoginRedirectRoute());
        }
      
        $id = (int) $this->params()->fromRoute('id', 0);

        if ($id == 0) {
            $this->flashMessenger()->addErrorMessage($this->getTranslatorHelper()->translate('User ID invalid'));
            return $this->redirect()->toRoute('user-admin');
        }
           
        try {
            $entityManager = $this->getEntityManager();
            $user = $entityManager->getRepository('CsnUser\Entity\User')->find($id);
            $entityManager->remove($user);
            $entityManager->flush();
            $this->flashMessenger()->addSuccessMessage($this->getTranslatorHelper()->translate('User Deleted Successfully'));
        }
        catch (\Exception $e) {
            return $this->getServiceLocator()->get('csnuser_error_view')->createErrorView(
                $this->getTranslatorHelper()->translate('Something went wrong during user delete process! Please, try again later.'),
                $e,
                $this->getOptions()->getDisplayExceptions(),
                false
            );
        }

        return $this->redirect()->toRoute('user-admin');
    }*/
    
    /**
     * Disable action
     *
     * Method to disable an user from his ID
     *
     * @return Zend\View\Model\ViewModel
     */
    /*public function setUserStateAction()
    {
        if(!$this->identity()) {
          return $this->redirect()->toRoute($this->getOptions()->getLoginRedirectRoute());
        }
      
        $id = (int) $this->params()->fromRoute('id', 0);
        $state = (int) $this->params()->fromRoute('state', -1);
        
        if ($id === 0 || $state === -1) {
            $this->flashMessenger()->addErrorMessage($this->getTranslatorHelper()->translate('User ID or state invalid'));
            return $this->redirect()->toRoute('user-admin');
        }
         
        try {
            $entityManager = $this->getEntityManager();
            $user = $entityManager->getRepository('CsnUser\Entity\User')->find($id);
            $user->setState($entityManager->find('CsnUser\Entity\State', $state));
            $entityManager->persist($user);
            $entityManager->flush();
            $this->flashMessenger()->addSuccessMessage($this->getTranslatorHelper()->translate('User Updated Successfully'));
        }
        catch (\Exception $e) {
          return $this->getServiceLocator()->get('csnuser_error_view')->createErrorView(
              $this->getTranslatorHelper()->translate('Something went wrong during user delete process! Please, try again later.'),
              $e,
              $this->getOptions()->getDisplayExceptions(),
              false
          );
        }
      
        return $this->redirect()->toRoute('user-admin');
    }*/

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
     * get roleFormHelper
     *
     * @return  Zend\Form\Form
     */
    private function getRoleFormHelper()
    {
        if (null === $this->roleFormHelper) {
           $this->roleFormHelper = $this->getServiceLocator()->get('csnauthorization_role_form');
        }
      
        return $this->roleFormHelper;
    }
}