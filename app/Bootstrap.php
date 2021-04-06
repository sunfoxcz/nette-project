<?php

declare(strict_types=1);

namespace App;

use Nette\Bootstrap\Configurator;


class Bootstrap
{
    public static function boot(): Configurator
    {
        $configurator = new Configurator;
        $appDir = dirname(__DIR__);

        if (getenv('NETTE_DEVEL') === '1') {
            $configurator->setDebugMode(true);
        }

        $configurator->enableTracy($appDir . '/var/log');

        setlocale(LC_ALL, 'cs_CZ.utf8');
        $configurator->setTimeZone('Europe/Prague');
        $configurator->setTempDirectory($appDir . '/var/temp');

        $configurator->createRobotLoader()
            ->addDirectory(__DIR__)
            ->register();

        $configurator->addConfig($appDir . '/config/common.neon');
        $configurator->addConfig($appDir . '/config/local.neon');

        return $configurator;
    }
}
