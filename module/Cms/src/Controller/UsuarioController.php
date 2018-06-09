<?php

namespace Cms\Controller;

use Cms\Form\UsuarioBuscaForm;
use Cms\Form\UsuarioForm;
use Cms\Model\Usuario;
use Cms\Model\UsuarioTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class UsuarioController extends AbstractActionController
{

    private $table;
    private $view;
    private $model;
    private $form;
    private $formBusca;

    public function __construct(UsuarioTable $table)
    {
        $this->table = $table;
        $this->view = new ViewModel();
        $this->form = new UsuarioForm();
        $this->formBusca = new UsuarioBuscaForm();
        $this->model = new Usuario();
    }

    public function listagemAction()
    {

        $this->model->exchangeArray($this->params()->fromQuery());
        $this->formBusca->bind($this->model);
        $this->view->setVariable('form', $this->formBusca);
        $this->view->setVariable('lista', $this->table->fetchAll($this->params()->fromQuery()));
        $this->view->setVariable('params', $this->params()->fromQuery());
        $this->view->setTemplate('cms/usuario/index');
        return $this->view;
    }

    public function cadastrarAction()
    {
        if ($this->getRequest()->isPost()) {
            $this->salvar();
        } else {
            $this->view->setVariable('form', new UsuarioForm());
            $this->view->setTemplate('cms/usuario/form');
            return $this->view;
        }

    }

    public function editarAction()
    {
        if ($this->getRequest()->isPost()) {
            $this->salvar();
        } else {

            $id = $this->params()->fromRoute('id');
            if ($id == 1)
                $this->redirect()->toRoute('usuario');

            $this->form->bind($this->table->find($id));

            $this->view->setVariable('form', $this->form);
            $this->view->setTemplate('cms/usuario/form');
            return $this->view;
        }
    }

    public function validar()
    {

        if (empty($this->model->nome))
            throw new \Exception('O nome é obrigatório');
        if (empty($this->model->email))
            throw new \Exception('O email é obrigatório');

        if ((int)$this->model->id <= 0) {

            $usuario = $this->table->fetchAll(['email' => $this->model->email]);
            if ((int)$usuario->id > 0)
                throw new \Exception('Este e-mail já está em uso');

            if (empty($this->model->senha))
                throw new \Exception('A senha é obrigatória');
        } else {
            $usuario = $this->table->find($this->model->id);
            if ($usuario->email != $this->model->email)
                throw new \Exception('Este e-mail não pertence a essa pessoa');

        }


    }

    public function salvar()
    {
        $this->view->setTerminal(TRUE);
        try {
            $this->model->exchangeArray($this->getRequest()->getPost()->toArray());
            $this->validar();
            $this->table->salvar($this->model);
            echo json_encode(['status' => TRUE, 'redirect' => '/usuario']);
        } catch (\Exception $e) {
            echo json_encode(['status' => FALSE, 'msg' => $e->getMessage()]);
        }
        die();
    }

    public function excluirAction()
    {
        $this->view->setTerminal(TRUE);
        try {
            $id = $this->params()->fromRoute('id');

            if ($id == 1)
                throw new \Exception('Você não pode excluir esse usuário!');

            $this->table->excluir($id);
            echo json_encode(['status' => TRUE, 'redirect' => '/usuario']);
        } catch (\Exception $e) {
            echo json_encode(['status' => FALSE, 'msg' => $e->getMessage()]);
        }
        die();
    }
}
