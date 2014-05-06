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

return array(
    'controllers' => array(
        'invokables' => array(
            'CsnAuthorization\Controller\RoleAdmin' => 'CsnAuthorization\Controller\RoleAdminController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'role-admin' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/role/admin[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'CsnAuthorization\Controller\RoleAdmin',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'csnauthorization' => 'CsnAuthorization\Service\Factory\AclFactory',
        ),
    ),
    'view_helpers' => array(
        'factories' => array(
            'isAllowed' => 'CsnAuthorization\View\Helper\Factory\IsAllowedFactory',
        ),
    ),
    'controller_plugins' => array(
        'factories' => array(
            'isAllowed' => 'CsnAuthorization\Controller\Plugin\Factory\IsAllowedFactory',
        ),
    ),
    'view_manager' => array(
        'display_exceptions' => true,
        'template_path_stack' => array(
            'csn-authorization' => __DIR__ . '/../view'
        ),
    ),
    'doctrine' => array(
        'configuration' => array(
            'orm_default' => array(
                'generate_proxies' => true,
            ),
        ),
        'driver' => array(
            'csnauthorization_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    __DIR__ . '/../src/CsnAuthorization/Entity',
                ),
            ),
            'orm_default' => array(
                'drivers' => array(
                    'CsnAuthorization\Entity' => 'csnauthorization_driver',
                )
            )
        )
    ),
);
