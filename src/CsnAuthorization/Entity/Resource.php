<?php
/**
 * Coolcsn Zend Framework 2 Authorization Module
 * 
 * @link https://github.com/coolcsn/CsnAuthorization for the canonical source repository
 * @copyright Copyright (c) 2005-2013 LightSoft 2005 Ltd. Bulgaria
 * @license https://github.com/coolcsn/CsnAuthorization/blob/master/LICENSE BSDLicense
 * @author Stoyan Cheresharov <stoyan@coolcsn.com>
 * @author Stoyan Revov <st.revov@gmail.com>
*/

namespace CsnAuthorization\Entity;

use Doctrine\ORM\Mapping as ORM;

use Zend\Form\Annotation; // !!!! Absolutely neccessary

/**
 * Resources
 *
 * @ORM\Table(name="resource")
 * @ORM\Entity
 * @Annotation\Name("resource")
 * @Annotation\Hydrator("Zend\Stdlib\Hydrator\ClassMethods")
 */
class Resource
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     * @Annotation\Filter({"name":"StringTrim"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":1, "max":30}})
     * @Annotation\Validator({"name":"Regex", "options":{"pattern":"/^[a-zA-Z][a-zA-Z0-9_ -]{0,100}$/"}})
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Resource:"})
     */
    protected $name;

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
     * Set name
     *
     * @param  string   $name
     * @return Resource
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
}
