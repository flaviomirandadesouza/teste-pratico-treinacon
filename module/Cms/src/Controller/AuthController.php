<?php

namespace Cms\Controller;

use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Adapter\DbTable\CallbackCheckAdapter;
use Zend\Authentication\AuthenticationServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\ViewModel;

class AuthController extends AbstractActionController
{
    private $authService;

    public function __construct(AuthenticationServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    public function onDispatch(MvcEvent $e)
    {
        $this->layout()->setTemplate('layout/auth');
        return parent::onDispatch($e); // TODO: Change the autogenerated stub
    }

    public function autenticacaoAction()
    {

        if ($this->authService->hasIdentity()) {
            $this->redirect()->toRoute('home-cms');
        }

        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            $authAdapter = $this->authService->getAdapter();
            $authAdapter->setIdentity($data['email']);
            $authAdapter->setCredential($data['senha']);
            $result = $this->authService->authenticate();

            if ($result->isValid()) {
                echo json_encode(['status' => TRUE, 'redirect' => '/usuario']);
            } else {
                echo json_encode(['status' => FALSE, 'msg' => 'Usuário ou senha inválidos']);
            }
            die();
        }

        return new ViewModel();
    }

    public function recuperarSenhaAction()
    {
        return new ViewModel();
    }

    public function redefinirSenhaAction()
    {
        return new ViewModel();
    }

    public function sairAction()
    {
        $this->authService->clearIdentity();
        $this->redirect()->toRoute('autenticacao');
    }
}
