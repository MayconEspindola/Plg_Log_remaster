<?php

namespace app\controllers;

use app\cadastro\FormularioBase;

require_once __DIR__ . "/FormFornecedor.php";

// Verifica se a requisição é do tipo POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Recupera os dados do formulário
    $dadosFormulario = [
        "notaFiscal" => $_POST["invoice"],
        "dataEmissao" => $_POST["dataEmissao"],
        "nomeFornecedor" => $_POST["nomeFornecedor"],
        "cnpjFornecedor" => $_POST["cnpjFornecedor"],
        "logradouro" => $_POST["Logradouro"],
        "cidade" => $_POST["cidade"],
        "estado" => $_POST["estado"],
        "cep" => $_POST["cep"]
    ];

    // Instancia um objeto FormFornecedor com os dados do formulário
    $formFornecedor = new FormFornecedor($dadosFormulario);

    // Armazena o objeto na sessão ou em outro local para acesso posterior
    $_SESSION["formFornecedor"] = $formFornecedor;

    // Redireciona para a página de registro de item
    header("Location: /views/register/registerItem.php");
    exit();
}

class FormFornecedor extends FormularioBase {
    private $dados;

    public function __construct($dados){
        $this->setDados($dados);
        $this->processarDados();
    }

    // Getter e Setter para dados
    public function getDados() {
        return $this->dados;
    }

    public function setDados($dados) {
        $this->dados = $dados;
    }

    // Processa os dados do formulário
    private function processarDados() {
        foreach ($this->getDados() as $propriedade => $valor) {
            $metodoSet = 'set' . ucfirst($propriedade);
            if (method_exists($this, $metodoSet)) {
                $this->$metodoSet($valor);
            }
        }
    }
}
?>