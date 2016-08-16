# Slim Package Manager

The goal of the package manager is to provide an API for including Inter-Operable Slim modules.

This document will outline how to structure your module and how to include modules

# Workflow

- Packages will install via composer.
- Packages will expose a config file in the root directory called package.php
- Packages will use PSR-4

# Config file

The config will will execute in a object scope (SlimPackageManager) and will have access to the API via `$this`
The package must register their routes, and template files via the API methods.


### Registering a route

`$this->app->get/post/put/delete/group(pattern, callabe) : Route`

### Registering your templates

Your template directory will be under VENDOR so it is recommended that you pre-plan and have a Global Object that returns the path to your template directory.

```php
class TemplateDirecoryLocator
{
  public function templatePath() {
    return __DIR__."/../templates";
  }
}
```

Then to register
```php
$this->registerTemplateDirectory((new TemplateDirectoryLocator)->templatePath());
```

### Register Your Dependencies

```php
$this-app->container['dep'] => function ($c) {
  return new Dep();
};
```


# Using a package

Pretty simple.

```php
$slimPackageManager->include("path/to/vendor/project/package.php");
```


### Sample package

```php
<?php

$this->app->get('/login', MyPackageNamespace\LoginController::class. ":login")->setName("user.login");
$this->app->post('/login', MyPackageNamespace\LoginController::class. ":processLogin")->setName("process.user.login");
$this->container[MyPackageNamespace\LoginController::class] => function ($c) {
    return new MyPackageNamespace\LoginController($c);
};

$this->registerTemplateDirectory((new MyNamespace\TemplateDirectoryLocator)->templatePath());
```


### Extending Packages
Extending packages is possible with https://github.com/slimphp/Slim/pull/1963 
It enables users to override the callable on a route with a new one.

Then it is possible to extend package classes with your own implementations.

```php
<?php

$slimPackageManager->include("./vendor/MyPackageNamespace/package.php");

$slimPackageManager->override("user.login", MyNamespace\LoginController::class. ":login");
```



