<?php

$loader = new Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */

$loader->registerNamespaces([
  'Raffledo\Forms'  => $config->application->formsDir,
  'Raffledo\Models' => $config->application->modelsDir,
  'Raffledo'        => $config->application->libraryDir
])->registerDirs([
  $config->application->formsDir,
  $config->application->modelsDir
])->register();
