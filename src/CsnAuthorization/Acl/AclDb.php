<?php
/**
 * Coolcsn Zend Framework 2 Authorization Module
 * 
 * @link https://github.com/coolcsn/CsnAuthorization for the canonical source repository
 * @copyright Copyright (c) 2005-2013 LightSoft 2005 Ltd. Bulgaria
 * @license https://github.com/coolcsn/CsnAuthorization/blob/master/LICENSE BSDLicense
 * @author Stoyan Revov <st.revov@gmail.com>
*/

namespace CsnAuthorization\Acl;

use Zend\Permissions\Acl\Acl as ZendAcl,
    Zend\Permissions\Acl\Role\GenericRole as Role,
    Zend\Permissions\Acl\Resource\GenericResource as Resource;

/**
 * Class to handle Acl
 *
 * This class is for loading ACL defined in a database
 *
 * @copyright Copyright (c) 2005-2013 LightSoft 2005 Ltd. Bulgaria
 * @license https://github.com/coolcsn/CsnAuthorization/blob/master/LICENSE BSDLicense
 */
class AclDb extends ZendAcl {
    /**
     * Default Role
     */
    const DEFAULT_ROLE = 'guest';

    /**
     * Constructor
     *
     * @param $entityManager Inject Doctrine's entity manager to load ACL from Database
     * @return void
     */
    public function __construct($entityManager)
    {
        $roles = $entityManager->findAll('CsnUser\Entity\Role');
        $resources = $entityManager->findAll('CsnAuthorization\Entity\Resource');
        $privileges = $entityManager->findAll('CsnAuthorization\Entity\Privilege');
        
        $this->_addRoles($roles)
             ->_addAclRules($resources, $privileges);
    }

    /**
     * Adds Roles to ACL
     *
     * @param array $roles
     * @return CsnAuthorization\Acl\AclDb
     */
    protected function _addRoles($roles)
    {
        foreach($roles as $role) {
            if (!$this->hasRole($role->getName())) {
                $parents = $role->getParents()->toArray();
                $parentNames = array();
                foreach($parents as $parent) {
                    $parentNames[] = $parent->getName();
                }
                $this->addRole(new Role($role->getName()), $parentNames);
            }
        }

        return $this;
    }

    /**
     * Adds Resources/privileges to ACL
     *
     * @param $resources
     * @param $privileges
     * @return User\Acl
     * @throws \Exception
     */
    protected function _addAclRules($resources, $privileges)
    {
        foreach ($resources as $resource) {
            if (!$this->hasResource($resource->getName())) {
                $this->addResource(new Resource($resource->getName()));
            }
        }
        
        foreach ($privileges as $privilege) {
            if($privilege->getPermissionAllow()) {
                $this->allow($privilege->getRole(), $privilege->getResource(), $privilege->getName());
            } else {
                $this->deny($privilege->getRole(), $privilege->getResource(), $privilege->getName());
            }
        }

        return $this;
    }
}
