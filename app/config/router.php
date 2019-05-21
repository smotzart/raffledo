<?php

$router = $di->getRouter();

$router->setDefaultModule('frontend');


$router->add('/:module',
  array(
    'module' => 1,
    'controller' => 'index',
    'action' => 'index',
  )
);

$router->add('/backend',
  array(
    'module' => 'backend',
    'controller' => 'games',
    'action' => 'index',
  )
);

$router->add('/:module/:controller',
  array(
    'module' => 1,
    'controller' => 2,
    'action' => 'index',
  )
);

$router->add('/:module/:controller/:action',
  array(
    'module' => 1,
    'controller' => 2,
    'action' => 3,
  )
);

$router->add('/:module/:controller/:action/:params',
  array(
    'module' => 1,
    'controller' => 2,
    'action' => 3,
    'params' => 4
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
