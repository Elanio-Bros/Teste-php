<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Core\ExecuteMigrations;

class DropTables extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'migration:drop';
    protected static $defaultDescription = 'Recriar tabelas';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        ExecuteMigrations::dropTables();
        echo "Todas as Tableas Foram Apagadas";
        return Command::SUCCESS;
    }
}
