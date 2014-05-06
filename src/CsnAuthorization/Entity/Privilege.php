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

namespace CsnAuthorization\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Doctrine ORM implementation of Privilege entity
 *
 * @ORM\Table(name="`privilege`")
 * @ORM\Entity
 */
class Privilege
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;
    
    /**
     * @var string
     *
     * @ORM\Column(name="resource", type="string", length=100, nullable=false)
     */
    protected $resource;

    /**
     * @var string
     *
     * @ORM\Column(name="privilege", type="string", length=100, nullable=false)
     */
    protected $privilege;
   
    /**
     * @var boolean
     *
     * @ORM\Column(name="is_allowed", type="boolean", nullable=false)
     */
    protected $isAllowed = false;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Set resource
     *
     * @param string $resource
     * @return CsnAuthorization\Entity\Privilege
     */
    public function setResource($resource)
    {
        $this->resource = $resource;

        return $this;
    }

    /**
     * Get resource
     *
     * @return string
     */
    public function getResource()
    {
        return $this->resource;
    }
    
    /**
     * Set privilege
     *
     * @param string $privilege
     * @return Privilege
     */
    public function setPrivilege($privilege)
    {
        $this->privilege = $privilege;
    
        return $this;
    }
    
    /**
     * Get privilege
     *
     * @return string
     */
    public function getPrivilege()
    {
        return $this->privilege;
    }
    
    /**
     * Set is allowed
     *
     * @param  boolean $isAllowed
     * @return CsnAuthorization\Entity\Privilege
     */
    public function setIsAllowed($isAllowed)
    {
        $this->isAllowed = $isAllowed;

        return $this;
    }
    
    /**
     * Get is allowed
     *
     * @return boolean
     */
    public function getIsAllowed()
    {
        return $this->isAllowed;
    }    
}
