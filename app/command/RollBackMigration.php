<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Core\ExecuteMigrations;

class RollBackMigration extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'migration:rollback';
    protected static $defaultDescription = 'Apagar Migrações';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        ExecuteMigrations::migration('down');
        echo "Todas As Migrações Foram Apagadas";
        return Command::SUCCESS;
    }
}
