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

$router->add("/impressum", [
  'module'     => 'frontend',
  'controller' => 'impressum',
  'action'     => 'index',
]);



$router->add("/gewinnspiele", [
  'module'     => 'frontend',
  'controller' => 'games',
  'action'     => 'index',
  'view_type'  => 'list'
]);

$router->add("/{view_tag:[a-zA-Z0-9-]+}-gewinnspiel", [
  'module'     => 'frontend',
  'controller' => 'games',
  'action'     => 'index',
  'view_type'  => 'tag'
]);

$router->add("/{view_tag:[a-zA-Z0-9-]+}-gewinnspiele", [
  'module'     => 'frontend',
  'controller' => 'games',
  'action'     => 'index',
  'view_type'  => 'company'
]);

$router->add("/no-filter", [
  'module'     => 'frontend',
  'controller' => 'games',
  'action'     => 'index',
  'view_type'  => 'all'
]);

$router->add("/suche", [
  'module'     => 'frontend',
  'controller' => 'games',
  'action'     => 'index',
  'view_type'  => 'search'
]);








$router->add("/neues", [
  'module'     => 'frontend',
  'controller' => 'new',
  'action'     => 'index'
]);

$router->add("/einstellungen", [
  'module'     => 'frontend',
  'controller' => 'settings',
  'action'     => 'index'
]);

$router->add("/einstellungen/:action/:params", [
  'module'     => 'frontend',
  'controller' => 'settings',
  'action'     => 1,
  'params'     => 2
]);


$router->add("/gewinnspiele/:action", [
  'module'     => 'frontend',
  'controller' => 'games',
  'action'     => 1
]);

$router->add("/win/{id:[0-9]+}", [
  'module'     => 'frontend',
  'controller' => 'games',
  'action'     => 'show'
]);

$router->removeExtraSlashes(true);

// Define your routes here

$router->handle();
