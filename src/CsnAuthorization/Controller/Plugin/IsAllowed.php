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

namespace CsnAuthorization\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use CsnAuthorization\Acl\Acl;

class IsAllowed extends AbstractPlugin {

    protected $auth;
    protected $acl;

    public function __construct($auth, $acl) {
        $this->auth = $auth;
        $this->acl = $acl;
    }

    /**
     * Checks whether the current user has acces to a resource.
     * 
     * @param string $resource
     * @param string $privilege
     */
    public function __invoke($resource, $privilege = null) {
        if ($this->auth->hasIdentity()) {
            $userRole = $this->acl->filterRoleName($this->auth->getIdentity()->getRole()->getName());
            if (!$this->acl->hasResource($resource)) {
                throw new \Exception('Resource ' . $resource . ' not defined');
            }
            return $this->acl->isAllowed($userRole, $resource, $privilege);
        } else {
            return $this->acl->isAllowed(Acl::DEFAULT_ROLE, $resource, $privilege);
        }
    }
}