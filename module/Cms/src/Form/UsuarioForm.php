<?php

namespace Cms\Form;

use Zend\Form\Form;

class UsuarioForm extends Form
{

    public function __construct()
    {
        parent::__construct('usuario', []);

        $this->setAttribute('action', $_SERVER["REQUEST_URI"]);
//        $this->setAttribute('method', 'POST');
        $this->setAttribute('onsubmit', 'return CRUD.salvar(this)');

        $this->add([
            'name' => 'id',
            'type' => 'hidden'
        ]);

        $this->add([
            'name'       => 'nome',
            'type'       => 'text',
            'attributes' => [
                'class' => 'form-control'
            ],
            'options'    => [
                'label' => 'Nome'
            ]
        ]);

        $this->add([
            'name'       => 'email',
            'type'       => 'text',
            'attributes' => [
                'class' => 'form-control'
            ],
            'options'    => [
                'label' => 'E-mail'
            ]
        ]);

        $this->add([
            'name'       => 'senha',
            'type'       => 'password',
            'attributes' => [
                'class' => 'form-control'
            ],
            'options'    => [
                'label' => 'Senha'
            ]
        ]);

        $this->add([
            'name'       => 'submit',
            'type'       => 'submit',
            'attributes' => [
                'class' => 'btn btn-success pull-right',
                'id'    => 'submit',
                'value' => 'Salvar'
            ]
        ]);
    }

}