<?php

namespace Cms\Controller;

use Cms\Form\UsuarioForm;
use Cms\Model\Usuario;
use Cms\Model\UsuarioTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

class UsuarioController extends AbstractActionController
{

    private $table;

    public function __construct(UsuarioTable $table)
    {
        $this->table = $table;
    }

    public function listagemAction()
    {
        $view = new ViewModel(['lista' => $this->table->fetchAll($_GET)]);
        $view->setTemplate('cms/usuario/index');
        return $view;
    }

    public function cadastrarAction()
    {
        if ($this->getRequest()->isPost()) {
            $this->salvar();
        } else {
            $view = new ViewModel(['form' => new UsuarioForm('usuario', [])]);
            $view->setTemplate('cms/usuario/form');
            return $view;
        }

    }

    public function editarAction()
    {
        if ($this->getRequest()->isPost()) {
            $this->salvar();
        } else {

            $id = $this->params()->fromRoute('id');
            $usuario = $this->table->find($id);
            $form = new UsuarioForm('usuario', []);
            $form->bind($usuario);
            $view = new ViewModel(['form' => $form]);
            $view->setTemplate('cms/usuario/form');
            return $view;
        }
    }

    public function salvar()
    {
        try {
            $request = $this->getRequest()->getPost()->toArray();
            $usuario = new Usuario();
            $usuario->exchangeArray($request);
            $this->table->salvar($usuario);
            echo json_encode(['status' => TRUE, 'redirect' => '/usuario']);
        } catch (\Exception $e) {
            echo json_encode(['status' => FALSE, 'msg' => $e->getMessage()]);
        }

        die();
    }

    public function excluirAction()
    {
        try {
            $id = $this->params()->fromRoute('id');
            $this->table->excluir($id);
            echo json_encode(['status' => TRUE, 'redirect' => '/usuario']);
        } catch (\Exception $e) {
            echo json_encode(['status' => FALSE, 'msg' => $e->getMessage()]);
        }
        die();
    }
}
