<?php
session_start();


require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/EnvironmentSettings.php';
require __DIR__ . '/../../vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    processarFormulario();
}

function processarFormulario() {
    $envSettings = new EnvironmentSettings();
    $env = $envSettings->obterConfiguracoes();
    $collectionName = $env['DATABASE']['collectionA1'];

    $database = Database::getConnection();
    $collection = $database->selectCollection($collectionName);

    $notaFiscal = isset($_SESSION["notaFiscal"]) ? $_SESSION["notaFiscal"] : '';
    $codigo = isset($_POST["codigo"]) ? $_POST["codigo"] : '';
    $modelo = isset($_POST["modelo"]) ? $_POST["modelo"] : '';
    $descricao = isset($_POST["descricao"]) ? $_POST["descricao"] : '';
    $logradouro = isset($_POST["Logradouro"]) ? $_POST["Logradouro"] : '';
    $cidade = isset($_POST["cidade"]) ? $_POST["cidade"] : '';
    $estado = isset($_POST["estado"]) ? $_POST["estado"] : '';
    $cep = isset($_POST["cep"]) ? $_POST["cep"] : '';

    if (dadosValidos($notaFiscal, $codigo, $modelo, $descricao, $logradouro, $cidade, $estado, $cep)) {
        $formFornecedor = new FormFornecedor($notaFiscal, $codigo, $modelo, $descricao, $logradouro, $cidade, $estado, $cep);
        salvarNoBanco($collection, $formFornecedor);
        redirecionar();
    } else {
        echo "Dados inválidos. Por favor, preencha todos os campos.";
    }
}

function dadosValidos($notaFiscal, $codigo, $modelo, $descricao, $logradouro, $cidade, $estado, $cep) {
    // Adicione validações conforme necessário
    return !empty($notaFiscal) && !empty($codigo) && !empty($modelo) && !empty($descricao);
}

function salvarNoBanco($collection, $formFornecedor) {
    $result = $collection->insertOne($formFornecedor);
}

function redirecionar() {
    header("Location: /views/register/registerItem.php");
    exit();
}

class FormProduto {
    private $codigo;
    private $modelo;
    private $descricao;
    private $altura;
    private $largura;
    private $comprimento;
    private $peso;
    private $quantidade;
    private $valorUnitario;
    private $valorTotal;

    public function __construct($codigo, $modelo, $descricao, $altura, $largura, $comprimento, $peso, $quantidade, $valorUnitario, $valorTotal) {
        $this->codigo = $codigo;
        $this->modelo = $modelo;
        $this->descricao = $descricao;
        $this->altura = $altura;
        $this->largura = $largura;
        $this->comprimento = $comprimento;
        $this->peso = $peso;
        $this->quantidade = $quantidade;
        $this->valorUnitario = $valorUnitario;
        $this->valorTotal = $valorTotal;
    }

    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }
}
?>