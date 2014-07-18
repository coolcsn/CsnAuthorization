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

namespace CsnAuthorization\Model;
 
use Doctrine\Common\Collections\ArrayCollection;

use CsnAuthorization\Entity\Privilege as PrivilegeEntity;

/**
 * Privilege model Class
 */
class Privilege
{
    /**
     * Create privilege array
     *
     * Method to create a set of privilege objects to be added to the Role
     *
     * @return ArrayCollection
     */
    public static function createPrivilegeArray($formFormattedPrivleges, &$role)
    {
        $privilegeArray = new ArrayCollection();
        foreach($formFormattedPrivleges as $Module => $value) {
            foreach($value as $Controller => $value) {
                foreach($value as $Action => $isAllowed) {
                    $privilege = new PrivilegeEntity();
                    $privilege->setRole($role);
                    $privilege->setResource($Module.'\\Controller\\'.$Controller);
                    $privilege->setPrivilege($Action);
                    $privilege->setIsAllowed($isAllowed);
                    $privilegeArray->add($privilege);
                }
            }
        }
        
        return $privilegeArray;
    }
    
    /**
     * Set form check boxes
     *
     * Method to set Role edit form check boxes
     */
    public static function setFormCheckBoxes($Privilege, &$form) {
        foreach($Privilege as $key => $privilege) {
            $resourceArray = explode("\\",$privilege->getResource());
            $module = $resourceArray[0];
            $controller = $resourceArray[2];
            $form->get('Privilege')->get($module)->get($controller)->get($privilege->getPrivilege())->setValue($privilege->getIsAllowed());
        }       
    }
}
