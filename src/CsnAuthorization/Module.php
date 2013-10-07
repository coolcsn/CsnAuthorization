<?php

/**
 * Coolcsn Zend Framework 2 Authorization Module
 * 
 * @link https://github.com/coolcsn/CsnAuthorization for the canonical source repository
 * @copyright Copyright (c) 2005-2013 LightSoft 2005 Ltd. Bulgaria
 * @license https://github.com/coolcsn/CsnAuthorization/blob/master/LICENSE BSDLicense
 * @author Stoyan Cheresharov <stoyan@coolcsn.com>, Stoyan Revov <st.revov@gmail.com>
 */

namespace CsnAuthorization;

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

    public function onRoute(\Zend\EventManager\EventInterface $e) { // Event manager of the app
        $application = $e->getApplication();
        $routeMatch = $e->getRouteMatch();
        $sm = $application->getServiceManager();
        $auth = $sm->get('Zend\Authentication\AuthenticationService');
        $acl = $sm->get('acl');
        // everyone is guest until logging in
        $role = Acl::DEFAULT_ROLE; // The default role is guest $acl

        if ($auth->hasIdentity()) {
            $user = $auth->getIdentity();
            $role = $user->getRole()->getName();
        }

        $controller = $routeMatch->getParam('controller');
        $action = $routeMatch->getParam('action');

        if (!$acl->hasResource($controller)) {
            throw new \Exception('Resource ' . $controller . ' not defined');
        }

        if (!$acl->isAllowed($role, $controller, $action)) {
            $response = $e->getResponse();
            $redirect_route = $sm->get('config')['acl']['redirect_route'];
            if(!empty($redirect_route)) {
                $url = $e->getRouter()->assemble($redirect_route['params'], $redirect_route['options']);
                $response->getHeaders()->addHeaderLine('Location', $url);
                // The HTTP response status code 302 Found is a common way of performing a redirection.
                // http://en.wikipedia.org/wiki/HTTP_302
                $response->setStatusCode(302);
                $response->sendHeaders();
                exit;
            } else {
                //Status code 403 responses are the result of the web server being configured to deny access,
                //for some reason, to the requested resource by the client.
                //http://en.wikipedia.org/wiki/HTTP_403
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