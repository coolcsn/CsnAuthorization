CsnAuthorization
=======

**What is CsnAuthorization?**

CsnAuthorization is a Module for Authorization based on DoctrineORMModule

**What exactly does CsnAuthorization do?**

CsnAuthorization has been created with educational purposes to demonstrate how Authorization can be done. It is fully functional.

**What's the use again?**

Nothing but yet another Authorization Module like BjyAuthorize.

Installation
============

Installation via composer is supported, simply add the following line to your ```composer.json```

```
"repositories": [
	{
		"type": "vcs",
		"url": "https://github.com/coolcsn/CsnAuthorization"
	}
],
"require" : {
    "coolcsn/csn-authorization": "dev-master"
}
```

After adding to the composer's packagist.org (not ready yet)

```
"require" : {
    "coolcsn/csn-authorization": "dev-master"
}
```

An example application configuration could look like the following:

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

This Module requires setting a connection for Doctrine and configuring the ACL.

Dependencies
============

This Module depends on the following Modules:

 - DoctrineORMModule
