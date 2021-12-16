<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Core\Database;
use App\Models\Usuario;
use Symfony\Component\Console\Input\InputArgument;

class CreateUsuario extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'create-usuario';
    protected static $defaultDescription = 'Criar um usuario';
    protected function configure(): void
    {
        $this
            ->addArgument('nome', InputArgument::REQUIRED)
            ->addArgument('usuario', InputArgument::REQUIRED)
            ->addArgument('email', InputArgument::REQUIRED)
            ->addArgument('senha', InputArgument::REQUIRED);
    }
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        Usuario::create([
            'nome' => $input->getArgument('nome'),
            'usuario' => $input->getArgument('usuario'),
            'email' => $input->getArgument('email'),
            'senha' => password_hash($input->getArgument('senha'), PASSWORD_DEFAULT),
        ]);
        echo "Usuário Criado";
        return Command::SUCCESS;
    }
}
