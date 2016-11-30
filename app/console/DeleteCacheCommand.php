<?php

namespace App\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class DeleteCacheCommand extends Command
{
    protected function configure()
    {
        $this->setName('cache:delete')
            ->setDescription('Delete Nette cache');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $projectDir = realpath(__DIR__ . '/../../');
        system("rm -r $projectDir/temp/cache");

        return 0;
    }
}
