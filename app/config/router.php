<?php

$router = $di->getRouter();

$router->setDefaultModule('frontend');



$router->add('/admin',
  array(
    'module' => 'backend',
    'controller' => 'games',
    'action' => 'index',
  )
);

$router->add('/admin/:controller',
  array(
    'module' => 'backend',
    'controller' => 1,
    'action' => 'index',
  )
);

$router->add('/admin/:controller/:action',
  array(
    'module' => 'backend',
    'controller' => 1,
    'action' => 2,
  )
);

$router->add('/admin/:controller/:action/:params',
  array(
    'module' => 'backend',
    'controller' => 1,
    'action' => 2,
    'params' => 3
  )
);

$router->add("/login", [
  'module'     => 'frontend',
  'controller' => 'session',
  'action'     => 'login',
])->setName('frontend-login');

$router->add("/logout", [
  'module'     => 'frontend',
  'controller' => 'session',
  'action'     => 'logout',
])->setName('frontend-logout');

$router->add("/datenschutz", [
  'module'     => 'frontend',
  'controller' => 'policy',
  'action'     => 'index',
]);

$router->add("/gewinnspiele", [
  'module'     => 'frontend',
  'controller' => 'games',
  'action'     => 'index',
]);

$router->add("/{search:[a-z]+}-gewinnspiele", [
  'module'     => 'frontend',
  'controller' => 'games',
  'action'     => 'search',
]);

$router->add("/win/{id:[0-9]+}", [
  'module'     => 'frontend',
  'controller' => 'games',
  'action'     => 'show'
]);

$router->removeExtraSlashes(true);

// Define your routes here

$router->handle();
