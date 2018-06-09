<?php

namespace Cms\Classe;

use Cms\Model\UsuarioTable;
use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\Adapter\DbTable;
use Zend\Authentication\Result;
use Zend\Config\Config;
use Zend\Db\Adapter\Adapter;

class AuthAdapter implements AdapterInterface
{
    protected $username;
    protected $password;

    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * Performs an authentication attempt
     *
     * @return \Zend\Authentication\Result
     * @throws \Zend\Authentication\Adapter\Exception\ExceptionInterface
     *               If authentication cannot be performed
     */
    public function authenticate()
    {
        $dbAdapter = new Adapter(array(
            'driver'   => 'Pdo',
            'dsn'      => 'mysql:dbname=treinacon;host=localhost',
            'username' => 'root',
            'password' => '123456'
        ));
        $teste = $dbAdapter->query("SELECT * FROM usuario WHERE email = 'usuario@gmai.com'");

        echo '<pre>';
        return Result::SUCCESS;
    }
}