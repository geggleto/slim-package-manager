# Slim Package Manager

This document will outline how to structure your module.

# Workflow

- Packages will install via composer.
- Packages will expose a config file in the root directory called package.php
- Packages will use PSR-4

# Config file

The config will will execute in a object scope (SlimPackageManager) and will have access to the API via `$this`
The package must register their routes, and template files via the API methods.


### Registering a route

`$this->get/post/put/delete/group(pattern, callabe) : Route`

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

