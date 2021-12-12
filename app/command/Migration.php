<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Core\ExecuteMigrations;

class Migration extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'migration';
    protected static $defaultDescription = 'Criar as Migrações';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        ExecuteMigrations::migration("up");
        echo "Todas As Tabelas Foram Criadas";
        return Command::SUCCESS;
    }
}
