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
- Run `./vendor/bin/doctrine-module orm:schema-tool:create` to generate the database privilege table for this module (Note: You may need to force the update by adding `--force` to the command). Import the sample SQL data (for some default ACL data) located in `./vendor/coolcsn/CsnAuthorization/data/SampleData.sql`. You can easily do that with PhpMyAdmin for instance.
- Set up your basic **Access Control List** configuration by copying `csnauthorization.global.php.dist` (located in `vendor/coolcsn/csn-authorization/config` if you have installed via *Composer*) into your `config/autoload` directory (Remove the .dist part). This is needed for basic ACL to work. Read the file for more details.

>### Does it work? ###
Navigate to a controller/action which has been allowed only for members in your ACL configuration and you should be redirected. Now login (preferably using CsnUser default user with `administrator` as the username and `superadmin` as the password.) and attempt that action again. Enjoy :)

Important Notes
-----------
- Wherever you need the acl object, just call `$serviceLocator->get('csnauthorization')`. It will properly construct a *Zend\Permissions\Acl\Acl* object based on the data in the basic ACL config file and the database.
- In your controllers or view scripts you can call `$this->isAllowed($resource, $privilege)` to check whether the current user has access to a resource.
- To add more Modules/Controllers/Action to the ACL, just take a look at `CsnAuthorization\Form` and `CsnAuthorization/view/csn-authorization/role-admin`

Routes
------------
The following routes are available (Only accessible for admin role users):

- **role/admin** Role admin view list.
- **role/admin/create-role** Create Role admin view.
- **role/admin/edit-role/RoleId*** Edit Role admin view.
- **role/admin/delete-role/RoleId*** Delete Role admin view.
 
* RoleId is an integer indicating the Role to by processed

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
