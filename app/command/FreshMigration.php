<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Core\Database;

class FreshMigration extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'migration:fresh';
    protected static $defaultDescription = 'Recriar tabelas';
    protected function configure(): void
    {
        $this->addOption('seed', null);
    }
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        Database::dropTables();
        Database::migration('up');
        if ($input->getOptions()['seed']) {
            echo Database::seeders();
        }
        echo "Todas As Migrações Foram Recriadas";
        return Command::SUCCESS;
    }
}
