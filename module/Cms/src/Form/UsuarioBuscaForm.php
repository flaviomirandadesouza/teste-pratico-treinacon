<?php

namespace Cms\Form;

use Zend\Form\Form;

class UsuarioBuscaForm extends Form
{

    public function __construct()
    {
        parent::__construct('usuario', []);

        $this->setAttribute('action', $_SERVER["REQUEST_URI"]);
        $this->setAttribute('method', 'GET');

        $this->add([
            'name'       => 'nome',
            'type'       => 'text',
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Buscar por nome...'
            ],
            'options'    => [
                'label' => 'Nome'
            ]
        ]);

    }

}