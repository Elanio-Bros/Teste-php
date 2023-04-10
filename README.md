# Teste Php
### Grupo Via Máquinas

## Informações do Sistemas
### Lógica da Aplicação
Aplicação é um sistema simples de Criação de Atividades com tela de Login, tela de cadastro não inclusa, porém o sistema ele já vem com um usuário pré cadastrado, que a senha pode ser alterado, ou criar outros usuários:

- **Usuário**: Admin
- **Senha**: Senha Admin

### Construção da Aplicação
Todo o sistema foi feito em base do PHP 8 com o Banco de Dados MySql, utilizando o padão **MVC** (Model, View, Controller) para melhor leitura, manutenção e segurança do sistema.

## Bibliotecas Utilizadas
Foi usado algumas bibliotecas para facilitar a criação e usabilidade do sistema:
 - [twig](https://twig.symfony.com/)
 - [phpdotenv](https://github.com/vlucas/phpdotenv)
 - [illuminate/database](https://github.com/illuminate/database)
 - [symfony/console](https://symfony.com/doc/current/components/console)
 
## Repositórios
O sistema foi baseado no padrão **MVC** (Model, View, Controller) onde divide a carga entre toda a aplicação para melhor otimização do sistema, melhor leitura de código e segurança.
 
### Repositório App
No repositório [\app](https://github.com/Elanio-Bros/Teste-php-via-maquinas/tree/main/app) ficam todos os arquivos de configuração e base da aplicação.

- [\command](https://github.com/Elanio-Bros/Teste-php-via-maquinas/tree/main/app/command): Repositório para os comandos personalizados utilizados no CLI(Terminal), comandos para Usuário, Migrações e Servidor.
- [\config](https://github.com/Elanio-Bros/Teste-php-via-maquinas/tree/main/app/config): Repositório para as configurações do sistema e funções globais.
- [\controller](https://github.com/Elanio-Bros/Teste-php-via-maquinas/tree/main/app/controller): Repositório do controladores utilizados na aplicação pela as rotas.
- [\core](https://github.com/Elanio-Bros/Teste-php-via-maquinas/tree/main/app/core): Repositório de toda a base da aplicação, classe essenciais para o sistema.
- [\database](https://github.com/Elanio-Bros/Teste-php-via-maquinas/tree/main/app/database): Repositório das migrações e seedres utilizando o padrão aplicado pelo o [illuminate/database](https://github.com/illuminate/database).
- [\models](https://github.com/Elanio-Bros/Teste-php-via-maquinas/tree/main/app/models): Repositório dos modelos de banco de dados utilizando os padrões do [illuminate/database](https://github.com/illuminate/database).
- [\routes](https://github.com/Elanio-Bros/Teste-php-via-maquinas/tree/main/app/models): Repositório das configuração das rotas da aplicação.
- [\view](https://github.com/Elanio-Bros/Teste-php-via-maquinas/tree/main/app/view): Repositório dos layouts das páginas utlizando os padrões do [twig](https://twig.symfony.com/).

### Repositório Public
No repositório [\public](https://github.com/Elanio-Bros/Teste-php-via-maquinas/tree/main/public) ficam todos os arquivos de inicialização do sistema e arquivos que podem ser acessados pelo o usuário.

## Comandos
O sistema conta com recurso de comandos utilizados via CLI(Termial), criados pela a biblioteca 
[symfony/console](https://symfony.com/doc/current/components/console) para melhor usabilidade do sistema. Para utilização dos comandos é necessario que esteja na pasta raiz do repositorio e execute:<br>
`php console.php [<comando>]`

### Lista de Comandos
- `list` **(Comando padrão do [symfony/console](https://symfony.com/doc/current/components/console))**:  listar todos os comandos do sistema

- `create-usuario [<nome>] [<usuário>] [<email>] [<senha>]`: adicionar um novo usuário ao sistema, **os argumentos nome, usuário, email e senha são obrigatorios**<br>
Exemplo:`php console.php create-usuario Mario Bros Mario@email.com 12345mario`

- `usuario-pass [<usuário>] [<nova_senha>]`: mudar a senha de um determinado usuario, **os argumentos usuário e nova_senha são obrigatorios**<br>
Exemplo de uso :`php console.php usuario-pass Bros mario12345`

- `migration`: executa todas as migraçõs para o banco de dados
    - `--seed`: introduz valores pré-definidos no banco de dados, **opção não obrigatoria**<br>
    Exemplo de uso:`php console.php migration --seed`
    
- `migration:fresh`: recarrega todas as migraçõs para o banco de dados
    - `--seed`: introduz valores pré-definidos no banco de dados, **opção não obrigatoria**<br>
    Exemplo de uso:`php console.php migration:fresh --seed`
    
- `migration:seed`: introduz valores pré-definidos no banco de dados

- `migration:drop`: apaga todas as tabelas do banco de dados

- `serve`: inicia um servidor interno

## Configurações da Aplicação
Primeiro crie um arquivo **.env** ou faça um clone do [`exemplo do arquivo env`](https://github.com/Elanio-Bros/Teste-php-via-maquinas/blob/main/.env.example) os requisitos dentro do arquivo **.env** são:
1. `DB_CONNECTION` ->Tipo de Banco de Dados (MySql)
2. `DB_HOST` -> Host do Banco de Dados
3. `DB_PORT` -> Porta do Banco de Dados
4. `DB_DATABASE` -> Nome do Banco de Dados
5. `DB_USERNAME` -> Usuário do Banco de Dados
6. `DB_PASSWORD` -> Senha do Banco de Dados
7. `TIME_ZONE` -> Fuso Horário, para [mais informações](https://www.php.net/manual/pt_BR/timezones.php)

Depois de configurado o arquivo **.env**, execute os comandos abaixo no CLI(Terminal) dentro do diretorio do sistema
<br><br>
Depois digite os commandos:
1. `composer install` -> para instalar as bibliotecas
2. `php console.php migration --seed` -> para criar todas as tabelas 
3. `php console.php serve`-> para iniciar o servidor interno em http://localhost:8000

## Cuidados
Configure o Arquivo **.env** para não causar erros ao sistema
