<?php

setlocale(LC_ALL, 'cs_CZ.utf8');

require __DIR__ . '/../vendor/autoload.php';

$configurator = new Nette\Configurator;

if (getenv('NETTE_DEVEL') === '1') {
    $configurator->setDebugMode(TRUE);
}

$configurator->setTimeZone('Europe/Prague');
$configurator->enableDebugger(__DIR__ . '/../log');
$configurator->setTempDirectory(__DIR__ . '/../temp');
$configurator->createRobotLoader()
    ->addDirectory(__DIR__)
    ->register();

$configurator->addConfig(__DIR__ . '/config/config.neon');
$configurator->addConfig(__DIR__ . '/config/config.local.neon');

$container = $configurator->createContainer();

return $container;
