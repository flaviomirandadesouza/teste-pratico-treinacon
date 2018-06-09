<?php

namespace Cms\Model;

class Usuario
{
    public $id;
    public $nome;
    public $email;
    public $salt;
    public $senha;
    public $hash;
    public $criado_em;
    public $criado_por;
    public $modificado_em;
    public $modificado_por;

    public function exchangeArray(array $dados)
    {
        $this->id = !empty($dados['id']) ? $dados['id'] : NULL;
        $this->nome = !empty($dados['nome']) ? $dados['nome'] : NULL;
        $this->email = !empty($dados['email']) ? $dados['email'] : NULL;
        $this->salt = !empty($dados['salt']) ? $dados['salt'] : NULL;
        $this->senha = !empty($dados['senha']) ? $dados['senha'] : NULL;
        $this->hash = !empty($dados['hash']) ? $dados['hash'] : NULL;
        $this->criado_em = !empty($dados['criado_em']) ? $dados['criado_em'] : NULL;
        $this->criado_por = !empty($dados['criado_por']) ? $dados['criado_por'] : NULL;
        $this->modificado_em = !empty($dados['modificado_em']) ? $dados['modificado_em'] : NULL;
        $this->modificado_por = !empty($dados['modificado_por']) ? $dados['modificado_por'] : NULL;
    }

    public function getArrayCopy()
    {
        return [
            'id'             => $this->id,
            'nome'           => $this->nome,
            'email'          => $this->email,
            'salt'           => $this->salt,
            'senha'          => $this->senha,
            'hash'           => $this->hash,
            'criado_em'      => $this->criado_em,
            'criado_por'     => $this->criado_por,
            'modificado_em'  => $this->modificado_em,
            'modificado_por' => $this->modificado_por
        ];
    }

}