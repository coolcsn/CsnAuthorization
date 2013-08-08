CsnAuthorization
=======

**What is CsnAuthorization?**

CsnAuthorization is a Module for Authorization based on DoctrineORMModule

**What exactly does CsnAuthorization do?**

CsnAuthorization has been created with educational purposes to demonstrate how Authorization can be done. It is fully functional.

**What's the use again?**

An alternative to BjyAuthorize.

Installation
============

Installation via composer is supported, simply add the following line to the *require* block of your ```composer.json```

```
    "coolcsn/csn-authorization": "dev-master"
```

Add this module to your application configuration. An example application configuration could look like the following:

```
'modules' => array(
    'Application',
    'DoctrineModule',
    'DoctrineORMModule',
    'CsnAuthorization'
)
```

Configuration
=============

This Module requires setting a connection for Doctrine and configuring the ACL (You can use the dist file in the *config* folder).

Dependencies
============

This Module depends on an Authentication module and:

 - DoctrineORMModule
