<?php

namespace Multiple\Frontend;

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
        'Multiple\Frontend\Controllers' => APP_PATH . '/frontend/controllers/',
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

        $dispatcher->setDefaultNamespace('Multiple\Frontend\Controllers');

        return $dispatcher;
      }
    );
    
    // Registering the view component
    $di->set(
      'view',
      function () {
        $view = new View();

        $view->setViewsDir(APP_PATH . '/frontend/views/');
        
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
  }
}