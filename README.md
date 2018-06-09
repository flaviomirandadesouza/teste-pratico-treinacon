
# Teste Prático (TREINACON)

## Introdução

Este projeto consiste em um CRUD e autenticação de usuários usando o Zend Framework 3 assim como também pacotes fornecidos pela Zend como zend-authentication, zend-db entre outros.

## Demo do projeto

Caso queira ver o projeto em execução, fiz o deploy da aplicação em um servidor pessoal, utilize os dados abaixo para acessar:

Host: http://vps65415.cloudpublic.com.br/

User: usuario@gmail.com

Pass: 123

*POR SEGURANÇA O USUÁRIO ACIMA NÃO PODE SER REMOVIDO OU EDITADO.

## Banco de dados

Optei por usar MySQL por ser um banco bastante conhecido e também amplamente disponível até em hospedagens grátis.

Segue o script para a criação do Banco e a tabela.
```
CREATE DATABASE treinacon;

USE treinacon;

CREATE TABLE treinacon.usuario (
     id INT(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
     nome VARCHAR(100) NOT NULL,
     email VARCHAR(100) NOT NULL,
     salt VARCHAR(32),
     senha VARCHAR(32)
   );
   
INSERT INTO treinacon.usuario(nome, email, salt, senha)
VALUES('Usuário', 'usuario@gmail.com', '202cb962ac59075b964b07152d234b70', 'babc156ac796828d0d08625f86f6dc55') 
```

## Instalação da Aplicação

Clone o projeto em seu diretorio de preferência

```bash
git clone https://github.com/flaviomirandadesouza/teste-pratico-treinacon.git
```

Entre no diretório que acabou de ser criado e baixe todos os pacotes necessários através do composer, basta executar o comando abaixo:

```bash
composer update
```

Agora configure os dados de conexão com o banco de dados, para isso basta alterar o arquivo config/autoload/global.php 

```bash
'db' => array(
        'driver'         => 'Pdo',
        'dsn'            => 'mysql:dbname=treinacon;host=localhost',
        'username'       => 'root',
        'password'       => '123456',
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
        ),
    ),
```

Agora você precisa instalar os componentes necessários para o template sb-admin, para isso entre no diretório public/template/sb-admin e execute o comando abaixo

```bash
npm i
```

Por fim você precisa utilizar o gulp para copiar os arquivos da pasta node_modules para vendor, para isso utilize o comando abaixo:

```bash
gulp vendor
```


Se nada deu errado nos passos acima o sistema está pronto para ser executado, você pode executá-lo usando o comando abaixo 

```bash
composer serve
```

