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

namespace CsnAuthorization\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use CsnAuthorization\Acl\Acl;

class AclFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
      return new Acl($serviceLocator);
    }
}
