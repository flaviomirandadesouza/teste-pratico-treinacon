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
        if ($this->getRequest()->isPost())
            $this->view->setTerminal(TRUE);

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
            $this->form->bind($this->table->find($id));

            $this->view->setVariable('form', $this->form);
            $this->view->setTemplate('cms/usuario/form');
            return $this->view;
        }
    }

    public function salvar()
    {
        try {
            $request = $this->getRequest()->getPost()->toArray();
            $this->table->salvar($request);
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
