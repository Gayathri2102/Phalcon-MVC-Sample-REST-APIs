<?php

$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */


$loader->registerDirs(
    [
        $config->application->controllersDir,
        $config->application->modelsDir,
        $config->application->servicesDir
    ]
);

$loader->registerNamespaces(
    [
        'App\Controllers' => $config->application->controllersDir,
        'App\Models'      => $config->application->modelsDir,
        'App\Services'    => $config->application->servicesDir
    ]
);

$loader->register();
