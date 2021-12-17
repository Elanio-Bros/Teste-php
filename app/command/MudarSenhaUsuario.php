<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Core\Database;
use App\Models\Usuario;
use Symfony\Component\Console\Input\InputArgument;

class MudarSenhaUsuario extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'usuario-pass';
    protected static $defaultDescription = 'mudar senha de usuário';
    protected function configure(): void
    {
        $this
            ->addArgument('usuario', InputArgument::REQUIRED)
            ->addArgument('senha', InputArgument::REQUIRED);
    }
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        Usuario::firstWhere(
            'usuario',
            $input->getArgument('usuario'),
        )->update([
            'senha' => password_hash($input->getArgument('senha'), PASSWORD_DEFAULT),
        ]);
        echo "Senha Alterada";
        return Command::SUCCESS;
    }
}
