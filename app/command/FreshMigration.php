<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Core\ExecuteMigrations;

class FreshMigration extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'migration:fresh';
    protected static $defaultDescription = 'Recriar tabelas';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        ExecuteMigrations::migration('down');
        ExecuteMigrations::migration('up');
        echo "Todas As Migrações Foram Recriadas";
        return Command::SUCCESS;
    }
}
