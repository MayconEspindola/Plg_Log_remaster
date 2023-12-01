<?php

require_once __DIR__ . '/registerFormProd.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera os dados do formulário
    $notaFiscal = $_POST["invoice"];
    $dataEmissao = $_POST["dataEmissao"];
    $nomeFornecedor = $_POST["nomeFornecedor"];
    $cnpjFornecedor = $_POST["cnpjFornecedor"];
    $logradouro = $_POST["Logradouro"];
    $cidade = $_POST["cidade"];
    $estado = $_POST["estado"];
    $cep = $_POST["cep"];

    // Instancia um objeto FormFornecedor
    $formFornecedor = new FormFornecedor($notaFiscal, $dataEmissao, $nomeFornecedor, $cnpjFornecedor, $logradouro, $cidade, $estado, $cep);

    // Armazena o objeto na sessão ou em outro local para acesso posterior
    $_SESSION["formFornecedor"] = $formFornecedor;


    header("Location: /views/register/registerItem.php");
    exit();
}

class FormFornecedor extends FormularioBase {
    private $NotaFiscal;
    private $DataEmissao;
    private $NomeFornecedor;
    private $CNPJFornecedor;
    private $Logradouro;
    private $Cidade;
    private $Estado;
    private $CEP;

    public function __construct($NotaFiscal, $DataEmissao, $NomeFornecedor, $CNPJFornecedor, $Logradouro, $Cidade, $Estado, $CEP){
        $this->setNotaFiscal($NotaFiscal);
        $this->setDataEmissao($DataEmissao);
        $this->setNomeFornecedor($NomeFornecedor);
        $this->setCNPJFornecedor($CNPJFornecedor);
        $this->setLogradouro($Logradouro);
        $this->setCidade($Cidade);
        $this->setEstado($Estado);
        $this->setCEP($CEP);
    }
    
    // Getter e Setter para NotaFiscal
    public function getNotaFiscal() {
        return $this->NotaFiscal;
    }

    public function setNotaFiscal($notaFiscal) {
        $this->NotaFiscal = $notaFiscal;
    }

    // Getter e Setter para DataEmissao
    public function getDataEmissao() {
        return $this->DataEmissao;
    }

    public function setDataEmissao($dataEmissao) {
        $this->DataEmissao = $dataEmissao;
    }

    // Getter e Setter para NomeFornecedor
    public function getNomeFornecedor() {
        return $this->NomeFornecedor;
    }

    public function setNomeFornecedor($nomeFornecedor) {
        $this->NomeFornecedor = $nomeFornecedor;
    }

    // Getter e Setter para CNPJFornecedor
    public function getCNPJFornecedor() {
        return $this->CNPJFornecedor;
    }

    public function setCNPJFornecedor($cnpjFornecedor) {
        $this->CNPJFornecedor = $cnpjFornecedor;
    }

    // Getter e Setter para Logradouro
    public function getLogradouro() {
        return $this->Logradouro;
    }

    public function setLogradouro($logradouro) {
        $this->Logradouro = $logradouro;
    }

    // Getter e Setter para Cidade
    public function getCidade() {
        return $this->Cidade;
    }

    public function setCidade($cidade) {
        $this->Cidade = $cidade;
    }

    // Getter e Setter para Estado
    public function getEstado() {
        return $this->Estado;
    }

    public function setEstado($estado) {
        $this->Estado = $estado;
    }

    // Getter e Setter para CEP
    public function getCEP() {
        return $this->CEP;
    }

    public function setCEP($cep) {
        $this->CEP = $cep;
    }
}
?>