# API Cidadão

API Cidadão para teste prático.

  - Acesso via Postman
  - Acesso via console para cadastro

# Instalação 

1. Baixar o projeto do git
```sh
    git clone git@github.com:tgfarias/apicidadao.git
```

## Via docker

2. Iniciar container docker no seu S.O
```sh
    docker-compose up -d --build
```
3. Criar uma cópia do arquivo .env.example para .env e adicionar as configurações do banco de dados.
```sh
    cp .env.example .env
```
4. Subindo a base de dados
```sh
    docker exec api php /var/www/html/artisan migrate
```
5. Url da api - {base_url}
```sh
{base_url}=http://localhost/public
```

## Via servidor embutido do PHP

2. Instalar as dependências do projeto
```sh
composer install
```
3. Criar o arquivo de configuração .env
```sh
cp .env.exemple .env
```
4. Editar o arquivo .env com as configurações do banco de dados
```sh
DB_CONNECTION=mysql

  Mysql - mysql
  Postgres - pgsql
  Sqlserver - sqlsrv

DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=cidadao
DB_USERNAME=root
DB_PASSWORD=root

DB_HOST - Host do banco
DB_PORT - Porta do banco
DB_DATABASE - Nome do banco
DB_USERNAME - Usuário do banco
```
5. Rodar a migration para criação das tabelas
```sh
php artisan migrate
```

6. Subir o servidor embutido
```sh
php -S localhost:80 -t public
```

# Rotas

Lista de cidadãos
```sh
{base_url}/api/persons - METHOD [GET]

http://localhost/public/api/persons
```
Consultar cidadão por CPF VÁLIDO
```sh
{base_url}/api/person/{cpf} - METHOD [GET]

http://localhost/public/api/person/19873792090
```
Inserir um cidadão
```sh
{base_url}/api/person/ - METHOD [POST]

http://localhost/public/api/person/
```
Atualizar um cidadão
```sh
{base_url}/api/person/{cpf} - METHOD [PUT]

http://localhost/public/api/person/19873792090
```
Remover um cidadão
```sh
{base_url}/api/person/{cpf} - METHOD [DELETE]

http://localhost/public/api/person/19873792090
```

# Acesso via terminal

 É necessário acessar a máquina docker [CONTAINER]=app para o cadastro de cidadão via terminal/controle:

- Métodos para acesso via terminal
   - [create-interactive.php]
   - [create-person.php]

Acessando a máquina docker
```sh
docker exec -it app bash
```
Chamada da função interativa:
```sh
php var/www/html/artisan create-interactive.php
```
Chamada da função por parâmetros:
- Inserir Cidadão com a seguinte ordem: {nome} {sobrenome} {cpf} {telefone} {email} {celular} {cep}
- telefone/email/celular usar aspas simples ' '
- telefone/celular usar padrão ddd com hífen. Ex.: (99) 9999-9999

```sh
php var/www/html/artisan create-person.php
```

### Tecnlogias utilizadas

#### Lumen
A escolha do framework [Lumen](https://lumen.laravel.com/) para desenvolvimento deste teste foi feita pelo fato de ser um micro-framework voltado para contruções de API, indepentende do padrão utilizado, REST ou GraphQL. O fw já trás uma arquitetura preparada para este tipo de projeto, desde usuários até as rotas de manipulação dos dados via acesso externo.
Este fw é baseado no [Laravel](https://laravel.com/) onde existe uma extensa comunidade ativa e inúmeros pacotes para integração do seu projeto. É um fw eficaz que facilita e agiliza o seu processo de criação de software.
#### Docker
O [docker](https://www.docker.com/) é uma plataforma que agiliza o processo de desenvolvimento sem ter que estar motando o ambiente de programação na sua máquina, através de containers você monta rapidamente seu ambiente e já começa a trabalhar.


License
----

MIT
