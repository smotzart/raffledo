<?php

namespace Multiple\Backend;

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\DiInterface;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;

class Module implements ModuleDefinitionInterface
{
  /**
   * Register a specific autoloader for the module
   */
  public function registerAutoloaders(DiInterface $di = null)
  {
    $loader = new Loader();

    $loader->registerNamespaces(
      [
        'Multiple\Backend\Controllers' => APP_PATH . '/backend/controllers/',
        'Multiple\Backend\Models'      => APP_PATH . '/backend/models/',
        'Multiple\Frontend\Models'      => APP_PATH . '/frontend/models/',
      ]
    );

    $loader->register();
  }

  /**
   * Register specific services for the module
   */
  public function registerServices(DiInterface $di)
  {

      // Registering a dispatcher
    $di->set(
      'dispatcher',
      function () {
        $dispatcher = new Dispatcher();

        $dispatcher->setDefaultNamespace('Multiple\Backend\Controllers');

        return $dispatcher;
      }
    );

    // Registering the view component
    $di->set(
      'view',
      function () {
        $view = new View();

        $view->setViewsDir(APP_PATH . '/backend/views/');
        $view->setLayout('index');
        $view->registerEngines([
          '.volt' => function ($view) {
            $config = $this->getConfig();

            $volt = new VoltEngine($view, $this);

            $volt->setOptions([
              'compiledPath' => $config->application->cacheDir,
              'compiledSeparator' => '_'
            ]);

            return $volt;
          },
          '.phtml' => PhpEngine::class

        ]);

        return $view;
      }
    );

    $di->set('url', function() use ($di) {
      $url = new \Phalcon\Mvc\Url();
      $url->setBaseUri("/admin/");
      // For frontend module.php:  $url->setBaseUri("/");
      return $url;
    });
  }
}