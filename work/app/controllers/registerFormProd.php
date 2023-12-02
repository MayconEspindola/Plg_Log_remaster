<?php

namespace app\controllers;

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/EnvironmentSettings.php';

interface Formulario {
    public function getDados();
}

class FormularioBase implements Formulario {
    protected $dados = [];

    public function getDados() {
        return $this->dados;
    }
}

class Cadastro {
    private $formularios = [];

    public function addForm(Formulario $formulario) {
        $this->formularios[] = $formulario;
    }

    public function register() {
        $dadosCadastro = $this->collectFormData();

        // Aqui você pode realizar o processo de cadastro no banco de dados
        // ou em qualquer outro lugar, utilizando os dados coletados.

        $this->processRegistration($dadosCadastro);
    }

    private function collectFormData() {
        $dadosCadastro = [];

        foreach ($this->formularios as $formulario) {
            $dadosCadastro = array_merge($dadosCadastro, $formulario->getDados());
        }

        return $dadosCadastro;
    }

    private function processRegistration($dadosCadastro) {
        // Aqui você pode adicionar a lógica específica para o processo de cadastro,
        // como a interação com o banco de dados ou outros serviços.

        // Exemplo de var_dump apenas para fins de debug
        var_dump($dadosCadastro);

        echo "Cadastro realizado com sucesso!";
    }
}

?>