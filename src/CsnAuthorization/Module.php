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

use Zend\Filter\Word\DashToCamelCase as DashToCamelCaseFilter;
use CsnAuthorization\Acl\Acl;

class Module {

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

    public function onBootstrap(\Zend\EventManager\EventInterface $e) { // use it to attach event listeners
        $application = $e->getApplication();
        $em = $application->getEventManager();
        $em->attach('route', array($this, 'onRoute'), -100);
    }

    public function onRoute(\Zend\EventManager\EventInterface $event) { // Event manager of the app
        $application = $event->getApplication();
        $sm = $application->getServiceManager();
        $auth = $sm->get('Zend\Authentication\AuthenticationService');
        $acl = $sm->get('acl');
        // everyone is Guest until logging in
        $role = Acl::DEFAULT_ROLE; // Default role is Guest

        if ($auth->hasIdentity()) {
            $user = $auth->getIdentity();
            $role = $user->getRole()->getName();
        }

        $routeMatch = $event->getRouteMatch();
        $controller = $routeMatch->getParam('controller');
        $action = $routeMatch->getParam('action');
        
        $dashToCamelCaseFilter = new DashToCamelCaseFilter();
        $action = lcfirst($dashToCamelCaseFilter->filter($action));

        if (!$acl->hasResource($controller)) {
            throw new \Exception('Resource ' . $controller . ' not defined');
        }

        if (!$acl->isAllowed($role, $controller, $action)) {
            $response = $event->getResponse();
            $config = $sm->get('config');
            $redirect_route = $config['acl']['redirect_route'];
            if(!empty($redirect_route)) {
                $url = $event->getRouter()->assemble($redirect_route['params'], $redirect_route['options']);
                $response->setHeaders($response->getHeaders()->addHeaderLine('Location', $url));
                $response->setStatusCode(302);
                $response->sendHeaders();
                exit();
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
    }
}