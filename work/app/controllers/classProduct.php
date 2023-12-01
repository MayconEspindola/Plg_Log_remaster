<?php
// Inicia a sessão
session_start();

// Verifica se o formulário foi submetido
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

    $formFornecedor = new FormFornecedor($notaFiscal, $dataEmissao, $nomeFornecedor, $cnpjFornecedor, $logradouro, $cidade, $estado, $cep);

    $_SESSION["formFornecedores"][] = $formFornecedor;

    header("Location: /views/register/registerItem.php");
    exit();
}


class FormProduto extends FormularioBase {
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

    // Construtor para inicializar os atributos
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

    // Métodos getters
    public function getCodigo() {
        return $this->codigo;
    }

    public function getModelo() {
        return $this->modelo;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function getAltura() {
        return $this->altura;
    }

    public function getLargura() {
        return $this->largura;
    }

    public function getComprimento() {
        return $this->comprimento;
    }

    public function getPeso() {
        return $this->peso;
    }

    public function getQuantidade() {
        return $this->quantidade;
    }

    public function getValorUnitario() {
        return $this->valorUnitario;
    }

    public function getValorTotal() {
        return $this->valorTotal;
    }

    // Métodos setters
    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function setModelo($modelo) {
        $this->modelo = $modelo;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function setAltura($altura) {
        $this->altura = $altura;
    }

    public function setLargura($largura) {
        $this->largura = $largura;
    }

    public function setComprimento($comprimento) {
        $this->comprimento = $comprimento;
    }

    public function setPeso($peso) {
        $this->peso = $peso;
    }

    public function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }

    public function setValorUnitario($valorUnitario) {
        $this->valorUnitario = $valorUnitario;
    }

    public function setValorTotal($valorTotal) {
        $this->valorTotal = $valorTotal;
    }
}
?>