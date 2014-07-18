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

namespace CsnAuthorization\Acl;

use Zend\Permissions\Acl\Acl as ZendAcl;
use Zend\Permissions\Acl\Role\GenericRole as Role;
use Zend\Permissions\Acl\Resource\GenericResource as Resource;

/**
 * Class to handle Acl rules, loading ACL definitions from config files and database for
 * the current logged in user only if possible.
 */
class Acl extends ZendAcl
{
    /**
     * Default Role
     */
    protected $defaultRole = 'guest';

    /**
     * Constructor
     *
     * @param $serviceLocator
     * @return void
     */
    public function __construct($serviceLocator)
    {
        /**
         * Get the default role from config file
         */
        $config = $serviceLocator->get('config');        
        if (!isset($config['csnauthorization']['default_role'])) {
            throw new \Exception('No default role set. Please review your acl.global.php config file.');
        } else {
            $this->setDefaultRole($config['csnauthorization']['default_role']);
        }        
        
        /**
         * Get the ACL rules from database for the current role only
         * bassed on the current logged in user if possible.
         */
        $auth = $serviceLocator->get('Zend\Authentication\AuthenticationService');
        if($auth->hasIdentity()) {
            $role = $auth->getIdentity()->getRole();
            $roleName = $this->filterRoleName($role->getName());
        } else {
            $roleName = $this->filterRoleName($this->getDefaultRole());
            $role = $serviceLocator->get('doctrine.entitymanager.orm_default')->getRepository('CsnUser\Entity\Role')->findOneBy(array('name' => $roleName));
        }  

        /**
         * Get some basic ACL rules from config file
         */        
        if (isset($config['csnauthorization']['roles']) && isset($config['csnauthorization']['resources'])) {
            $roles = $config['csnauthorization']['roles'];        
            $this->_addConfigDefinedRoles($roles)
                 ->_addConfigDefinedResources($config['csnauthorization']['resources']);
        }
        
        /**
         * Get the rest of the ACL rules that got loaded from database
         */
        $this->_addDatabaseDefinedRole($roleName)
             ->_addDatabaseDefinedAclRules($roleName, $role->getPrivilege());
    }
    
    /**
     * Filter role name
     *
     * @param array $roleName
     * @return string
     */
    public function filterRoleName($roleName)
    {
        return str_replace(' ', '-', strtolower($roleName));
    }
    
    /**
     * Set default role
     *
     * @param array $defaultRole
     * @return string
     */
    private function setDefaultRole($defaultRole)
    {
        $this->defaultRole = $defaultRole;
    }
    
    /**
     * Get default role
     *
     * @return string
     */
    
    public function getDefaultRole()
    {
        return $this->defaultRole;
    }
    
    /**
     * Adds config defined roles to ACL
     *
     * @param array $roles
     * @return CsnAuthorization\Acl\Acl
     */
    protected function _addConfigDefinedRoles($roles)
    {
        foreach ($roles as $name => $parent) {
            if (!$this->hasRole($name)) {
                if (empty($parent)) {
                    $parent = array();
                } else {
                    $parent = explode(',', $parent);
                }
    
                $this->addRole(new Role($name), $parent);
            }
        }
    
        return $this;
    }
    
    /**
     * Adds module defined resources/privileges to ACL
     *
     * @param $resources
     * @return CsnAuthorization\Acl\Acl
     * @throws \Exception
     */
    protected function _addConfigDefinedResources($resources)
    {
        foreach ($resources as $permission => $controllers) {
            foreach ($controllers as $controller => $actions) {
                if ($controller == 'all') {
                    $controller = null;
                } else {
                    if (!$this->hasResource($controller)) {
                        $this->addResource(new Resource($controller));
                    }
                }
    
                foreach ($actions as $action => $role) {
                    if ($action == 'all') {
                        $action = null;
                    }
    
                    if ($permission == 'allow') {
                        $this->allow($role, $controller, $action);
                    } elseif ($permission == 'deny') {
                        $this->deny($role, $controller, $action);
                    } else {
                        throw new \Exception('No valid permission defined: ' . $permission);
                    }
                }
            }
        }
    
        return $this;
    }    

    /**
     * Adds database defined role to ACL
     *
     * @param array $roleName
     * @return CsnAuthorization\Acl\Acl
     */
    protected function _addDatabaseDefinedRole($roleName)
    {
        if (!$this->hasRole($roleName)) {
            $this->addRole(new Role($roleName));
        }
        
        return $this;
    }

    /**
     * Adds resources/privileges to ACL
     *
     * @param $roleName
     * @param $privileges
     * @return CsnAuthorization\Acl\Acl
     * @throws \Exception
     */
    protected function _addDatabaseDefinedAclRules($roleName, $privileges)
    {
        foreach($privileges as $privilege) {
            if (!$this->hasResource($privilege->getResource())) {
                $this->addResource(new Resource($privilege->getResource()));
            }
            
            if($privilege->getIsAllowed()) {
                $this->allow($roleName, $privilege->getResource(), $privilege->getPrivilege());
            } else {
                $this->deny($roleName, $privilege->getResource(), $privilege->getPrivilege());
            }
        }

        return $this;
    }
}
