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

namespace CsnAuthorization;

use Zend\EventManager\EventInterface;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\ViewModel;
use Zend\Stdlib\Response as StdResponse;

use CsnAuthorization\Acl\Acl;

class Module
{
    public function onBootstrap(EventInterface $event) {
        $application = $event->getApplication();
        $em = $application->getEventManager();
        $em->attach('route', array($this, 'onRoute'), -100);
        $em->attach(MvcEvent::EVENT_DISPATCH_ERROR, array($this, 'onDisplayAclForbiddenError'), -999);        
    }

    public function onRoute(\Zend\EventManager\EventInterface $event) {
        $application = $event->getApplication();
        $sm = $application->getServiceManager();
        $auth = $sm->get('Zend\Authentication\AuthenticationService');
        $acl = $sm->get('csnauthorization');

        /**
         *  Everyone is default role until logged in.
         *  This is configured in acl.global.php
         */
        $roleName = $acl->getDefaultRole();
        if ($auth->hasIdentity()) {
            $user = $auth->getIdentity();
            $roleName = $acl->filterRoleName($user->getRole()->getName());
        }

        $controller = $event->getRouteMatch()->getParam('controller');
        if(!$acl->hasResource($controller)) {
            throw new \Exception('Resource ' . $controller . ' not defined');
        }

        $action = $event->getRouteMatch()->getParam('action');
        if($acl->isAllowed($roleName, $controller, $action)) {
            return;
        } else {
            $event->setError('ACL_FORBIDDEN')
                  ->setParam('route', $event->getRouteMatch()->getMatchedRouteName());
            $application->getEventManager()->trigger(MvcEvent::EVENT_DISPATCH_ERROR, $event);
        }
    }
    
    public function onDisplayAclForbiddenError(EventInterface $event) {
        $error = $event->getError();
        if(empty($error) || $error != "ACL_FORBIDDEN") {
            return;
        }
        unset($error);
        
        $result = $event->getResult();
        if(StdResponse instanceof $result) {
            return;
        }
        unset($result);
        
        $model = new ViewModel();
        $model->setTemplate('csn-authorization/error/403');
        
        $baseModel = new ViewModel();
        $baseModel->setTemplate('layout/layout')
                  ->addChild($model)
                  ->setTerminal(true);
        
        $response = $event->getResponse();
        $response->setStatusCode(403);
        
        $event->setViewModel($baseModel)
              ->setResponse($response)
              ->stopPropagation(true);
    }
    
    public function getConfig() {
        return include __DIR__ . '/../../config/module.config.php';
    }
    
    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/../../src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
