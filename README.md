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
- Installation via composer is supported, simply run:
`php composer.phar require coolcsn/csn-authorization:dev-master`

- Add 'CsnAuthorization' to your application configuration in `config/application.config.php`. An example application configuration could look like the following:
```
'modules' => array(
    'Application',
    'CsnUser',
    'CsnAuthorization'
)
```
- CsnAuthorization requires setting a connection for Doctrine (if you haven't done this for some of your other modules). You can paste the following snippet in `config/autoload/doctrine.local.php`, replacing the tokens with your actual connection parameters:
```
return array(
  'doctrine' => array(
    'connection' => array(
      'orm_default' => array(
        'driverClass' =>'Doctrine\DBAL\Driver\PDOMySql\Driver',
        'params' => array(
          'host'     => 'localhost',
          'port'     => '3306',
          'user'     => 'username',
          'password' => 'password',
          'dbname'   => 'database',
)))));
```
- After that, set up your Access Control List configuration by copying `acl.global.php.dist` (located in `vendor/coolcsn/csn-authorization/config` if you have installed via *Composer*) into your ./config/autoload directory (Remove the .dist part).

>### Does it work? ###
Navigate to a controller/action which has been allowed only for members in your ACL configuration and you should be redirected. Now login (preferably using CsnUser) and attempt that action again. Enjoy :)

Dependencies
------------
This Module depends on the following Modules:

 - DoctrineORMModule
 - CsnUser (Decoupling - coming soon!!!)

Recommends
----------
 - CsnUser - Authentication (login, registration) module, fully compatible with CsnAuthorization.
 - CsnNavigation - Navigation panel;
 - CsnCms - Content management system;