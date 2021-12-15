<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Core\Database;

class Seeders extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'migration:seed';
    protected static $defaultDescription = 'Criar Valores Predefinidos no banco de dadoss';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        Database::seeders();
        echo "Valore Adicionados";
        return Command::SUCCESS;
    }
}
