<?php
/**
 * Created by PhpStorm.
 * User: Glenn
 * Date: 2016-08-16
 * Time: 3:52 PM
 */

namespace SlimPackage;


class PackageManager
{
    protected $app;
    protected $container;

    public function __construct(\Slim\App $app)
    {
        $this->app = $app;
        $this->container = $app->getContainer();
    }


    public function includePackage($path) {
        if (!file_exists($path)) {
            throw new \InvalidArgumentException("Package File Does Not Exist");
        }

        include $path;
    }

    public function registerTemplateDirectory($path) {
        throw new \Exception("Not Implemented");
    }

    public function override($routeName, $callable) {
        $route = $this->app->router->getNamedRoute($routeName);\
        $route->setCallable($callable); //Will be fixed with /slim/slim/#1963
    }
}