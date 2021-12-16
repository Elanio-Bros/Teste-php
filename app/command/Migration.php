<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Core\Database;

class Migration extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'migration';
    protected static $defaultDescription = 'Criar as Migrações';
    protected function configure(): void
    {
        $this->addOption('seed', null);
    }
    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        Database::migration("up");
        if ($input->getOptions()['seed']) {
            Database::seeders();
        }
        echo "Todas As Tabelas Foram Criadas";
        return Command::SUCCESS;
    }
}
