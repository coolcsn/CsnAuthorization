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
use Zend\Form\Annotation;

/**
 * Privileges
 *
 * @ORM\Table(name="privilege")
 * @ORM\Entity
 * @Annotation\Name("Privilege")
 * @ Annotation\Hydrator("Zend\Stdlib\Hydrator\ClassMethods")
 */
class Privilege
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Annotation\Exclude()
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Filter({"name":"StringTrim"})
     * @Annotation\Validator({"name":"StringLength", "options":{"encoding":"UTF-8", "min":6, "max":100}})
     * @Annotation\Validator({"name":"Regex", "options":{"pattern":"/^[a-zA-Z][a-zñA-ZÑ0-9\_\ \-]+$/"}})
     * @Annotation\Required(true)
     * @Annotation\Attributes({
     *   "type":"text",
     *   "required":"true"
     * })
     * @Annotation\Options({"label":"Privilege:"})
     */
    protected $name;

    /**
     * @var CsnAuthorization\Entity\Resource
     *
     * @ORM\ManyToOne(targetEntity="CsnAuthorization\Entity\Resource")
     * @ORM\JoinColumn(name="resource_id", referencedColumnName="id", nullable=false)
     * @Annotation\Type("DoctrineModule\Form\Element\ObjectSelect")
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Filter({"name":"StringTrim"})
     * @Annotation\Validator({"name":"Digits"})
     * @Annotation\Required(true)
     * @Annotation\Options({
     *   "required":"true",
     *   "empty_option": "Select Resource",
     *   "target_class":"CsnAuthorization\Entity\Resource",
     *   "property": "name",
     *   "label":"Resource:"
     * })
     */
    protected $resource;
    
    /**
    * @var CsnUser\Entity\Role
    *
    * @ORM\ManyToOne(targetEntity="CsnUser\Entity\Role")
    * @ORM\JoinColumn(name="role_id", referencedColumnName="id", nullable=false)
    * @Annotation\Type("DoctrineModule\Form\Element\ObjectSelect")
    * @Annotation\Filter({"name":"StripTags"})
    * @Annotation\Filter({"name":"StringTrim"})
    * @Annotation\Validator({"name":"Digits"})
    * @Annotation\Required(true)
    * @Annotation\Options({
    *   "required":"true",
    *   "empty_option": "Allow User Role",
    *   "target_class":"CsnUser\Entity\Role",
    *   "property": "name",
    *   "label":"Role:"
    * })
    */
    protected $role;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="allow", type="boolean", nullable=false)
     * @Annotation\Type("Zend\Form\Element\Checkbox")
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Filter({"name":"StringTrim"})
     * @Annotation\Validator({"name":"Digits"})
     * @Annotation\Options({
     *   "label":"Allow?:"
     * })
     */
    protected $permissionAllow = true;

    /**
     * Set name
     *
     * @param  string   $name
     * @return Privilege
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

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
     * @param  CsnAuthorization\Entity\Resource $resource
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
     * @return CsnAuthorization\Entity\Resource
     */
    public function getResource()
    {
        return $this->resource;
    }
    
    /**
     * Set role
     *
     * @param  Role $role
     * @return CsnAuthorization\Entity\Privilege
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return Role
     */
    public function getRole()
    {
        return $this->role;
    }
    
    /**
     * Set permissionAllow
     *
     * @param  boolean $permissionAllow
     * @return CsnAuthorization\Entity\Privilege
     */
    public function setPermissionAllow($permissionAllow)
    {
        $this->permissionAllow = $permissionAllow;

        return $this;
    }
    
    /**
     * Get permissionAllow
     *
     * @return boolean
     */
    public function getPermissionAllow()
    {
        return $this->permissionAllow;
    }    
}
