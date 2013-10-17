CsnAuthorization
================

### What is CsnAuthorization? ###
CsnAuthorization is an Authorization module based on `Access Control List` and `DoctrineORMModule`.

### What exactly does CsnAuthorization do? ###
CsnAuthorization has been created with educational purposes to demonstrate how Authorization can be done. It is fully functional.
Authorization is the process of giving access rights to a user on a set of resourses(in our case - controllers) and determining their privileges(in our case - actions) on those resourses.

### What's the use again? ###
An alternative to BjyAuthorize, working in perfect harmony with *Doctrine* and the other Csn modules.

Installation
------------
- Installation via composer is supported, simply run (make sure you've set `"minimum-stability": "dev"` in your *composer.json* file):
`php composer.phar require coolcsn/csn-authorization:dev-master`
- Configure referenced module ([CsnUser](https://github.com/coolcsn/CsnUser)) following its instructions.
- Add 'CsnAuthorization' to your application configuration in `config/application.config.php`. An example application configuration could look like the following:

```
'modules' => array(
    'Application',
    'DoctrineModule',
    'DoctrineORMModule',
    'CsnUser',
    'CsnAuthorization'
)
```

- Set up your **Access Control List** configuration by copying `acl.global.php.dist` (located in `vendor/coolcsn/csn-authorization/config` if you have installed via *Composer*) into your `config/autoload` directory (Remove the .dist part).
- **Recommended:** Run `./vendor/bin/doctrine-module orm:schema-tool:update` to update the database schema if you are going to store the ACL in the database (**Note:** You may need to force the update by adding ` --force` to the command).
- **Optional:** If you prefer to load the ACL from the database, make sure you've completed the previous step, then set `use_database_storage = true` in the acl config. Import the sample ACL located in `./vendor/coolcsn/CsnAuthorization/data/SampleData.sql`. You can easily do that with *PhpMyAdmin* for instance.

>### Does it work? ###
Navigate to a controller/action which has been allowed only for members in your ACL configuration and you should be redirected. Now login (preferably using CsnUser) and attempt that action again. Enjoy :)

Important Notes
-----------
- Wherever you need the acl object, just call `$serviceLocator->get('acl')`. It will properly construct a *Zend\Permissions\Acl\Acl* object based on the data in the config or the database.
- In your controllers or view scripts you can call `$this->isAllowed($resource, $privilege)` to check whether the current user has access to a resource.

Dependencies
------------
This Module depends on the following Modules:

- DoctrineORMModule
- CsnUser (Decoupling - coming soon!!!)

Recommends
----------
- [coolcsn/CsnUser](https://github.com/coolcsn/CsnUser) - Authentication (login, registration) module.
- [coolcsn/CsnAclNavigation](https://github.com/coolcsn/CsnAclNavigation) - Navigation module;
- [coolcsn/CsnCms](https://github.com/coolcsn/CsnCms) - Content management system;