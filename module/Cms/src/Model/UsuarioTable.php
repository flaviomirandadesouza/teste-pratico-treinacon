<?php

namespace Cms\Model;

use Zend\Db\TableGateway\TableGatewayInterface;

class UsuarioTable
{

    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        return $this->tableGateway->select();
    }

    public function find($id)
    {
        $id = (int)$id;
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();

        return $row;
    }

    public function limparCamposNulos($data)
    {
        foreach ($data as $key => $value)
            if ($value === NULL)
                unset($data[$key]);
        return $data;
    }

    public function salvar(Usuario $usuario)
    {
        $data = $usuario->getArrayCopy();

        $id = (int)$usuario->id;
        if ($id === 0) {
            $data['salt'] = md5(date('Y-m-d H:i:s') . uniqid());
            $data['senha'] = md5($data['salt'] . $data['senha']);
            $data['criado_em'] = date('Y-m-d H:i:s');
            $data['criado_por'] = 1;
            $this->tableGateway->insert($this->limparCamposNulos($data));
            return;
        }

        if (!$this->find($id))
            throw new \Exception(sprintf('Não existe usuário com o id %d', $id));


        if (!empty($data['senha'])) {
            $data['salt'] = md5(date('Y-m-d H:i:s') . uniqid());
            $data['senha'] = md5($data['salt'] . $data['senha']);
        }
        $data['modificado_em'] = date('Y-m-d H:i:s');
        $data['modificado_por'] = 1;
        $this->tableGateway->update($this->limparCamposNulos($data), ['id' => $id]);
    }

    public function excluir($id)
    {
        $this->tableGateway->delete(['id' => $id]);
    }
}