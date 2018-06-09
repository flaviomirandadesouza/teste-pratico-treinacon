<?php

namespace Cms\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AuthController extends AbstractActionController
{
    public function autenticacaoAction()
    {
        return new ViewModel();
    }

    public function recuperarSenhaAction()
    {
        return new ViewModel();
    }

    public function validarRecuperacaoSenhaAction()
    {
        return new ViewModel();
    }
}
