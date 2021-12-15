<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ServerStart extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'server';
    protected static $defaultDescription = 'Iniciar Servidor';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        return shell_exec('php -S 127.0.0.1:8000 -t public');
    }
}
