<?php

namespace Multiple\Backend;

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\DiInterface;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Flash\Session as FlashSession;

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
      function () use ($di) {
        $dispatcher = new Dispatcher();

        $dispatcher->setDefaultNamespace('Multiple\Backend\Controllers');

        $evManager = $di->getShared('eventsManager');

        $evManager->attach(
            "dispatch:beforeException",
            function($event, $dispatcher, $exception)
            {
                switch ($exception->getCode()) {
                    case Dispatcher::EXCEPTION_HANDLER_NOT_FOUND:
                    case Dispatcher::EXCEPTION_ACTION_NOT_FOUND:
                        $dispatcher->forward(
                            array(
                                'controller' => 'games',
                                'action'     => 'index',
                            )
                        );
                        return false;
                }
            }
        );
        $dispatcher->setEventsManager($evManager);

        return $dispatcher;
      }
    );
    
    $di->set('flashSession', function () {
        return new FlashSession([
            'error'   => 'alert alert-danger',
            'success' => 'alert alert-success',
            'notice'  => 'alert alert-info',
            'warning' => 'alert alert-warning'
        ]);
    });


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

            $compiler = $volt->getCompiler();
            $compiler->addFunction('str_replace', 'str_replace');
            $compiler->addFunction('explode', 'explode');

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
      return $url;
    });

  }
}