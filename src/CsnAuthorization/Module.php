<?php

namespace CsnAuthorization;

use CsnAuthorization\Acl\Acl;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/../../config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/../../src/' . __NAMESPACE__,
                ),
            ),
        );
    }

	public function onBootstrap(\Zend\EventManager\EventInterface $e) // use it to attach event listeners
	{
		$application = $e->getApplication();
		$em = $application->getEventManager();
		$em->attach('route', array($this, 'onRoute'), -100);
	}
	
	public function onRoute(\Zend\EventManager\EventInterface $e) // Event manager of the app
	{
		$application = $e->getApplication();
		$routeMatch = $e->getRouteMatch();
		$sm = $application->getServiceManager();
		$auth = $sm->get('Zend\Authentication\AuthenticationService');
		$config = $sm->get('Config');
		$acl = new Acl($config);
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
			$url = $e->getRouter()->assemble(array(), array('name' => 'home'));
			$response = $e->getResponse();

			$response->getHeaders()->addHeaderLine('Location', $url);
			// The HTTP response status code 302 Found is a common way of performing a redirection.
			// http://en.wikipedia.org/wiki/HTTP_302
			$response->setStatusCode(302);
			$response->sendHeaders();
			exit;
		}
	}
}