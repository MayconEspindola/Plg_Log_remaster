<?php
session_start();

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/EnvironmentSettings.php';

$nomeUsuario = isset($_SESSION["username"]) ? $_SESSION["username"] : null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cod = $_POST['codigo'];
    $model = strtoupper($_POST['modelo']);
    $description = strtoupper($_POST['description']);
    $altura = converterParaPonto($_POST["altura"]);
    $largura = converterParaPonto($_POST["largura"]);
    $comprimento = converterParaPonto($_POST["comprimento"]);
    $peso = converterParaPonto($_POST["peso"]);

    $codigoControle = $cod;

    $dataHoraInsercao = date('d/m/Y-H:i:s');

    $envSettings = new \app\config\EnvironmentSettings();
    $env = $envSettings->obterConfiguracoes();
    $collectionName = $env['DATABASE']['collectionA1'];

    $database = \app\config\Database::getConnection();
    $collection = $database->selectCollection($collectionName);

    $verificarCodigo = $collection->findOne(['codigo' => (int) $codigoControle]);

    if (verificarCadastro($verificarCodigo, $codigoControle, $collection)) {
        $document = [
            'encarregado' => $nomeUsuario,
            'codigo' => (int) $codigoControle,
            'modelo' => $model,
            'descricao' => $description,
            'altura' => floatval($altura),
            'largura' => floatval($largura),
            'comprimento' => floatval($comprimento),
            'peso' => floatval($peso),
            'dataHoraInsercao' => $dataHoraInsercao,
        ];

        cadastrarProduto($collection, $document);
    } else {
        echo "<script>alert('Não foi possível cadastrar este produto devido a um código já existente');</script>";
        redirecionar('/views/register/registerItem.php');
    }
} else {
    echo "Método inválido";
}

function verificarCadastro($verificarCodigo, $codigoControle, $collection) {
    return !$verificarCodigo;
}

function cadastrarProduto($collection, $document) {
    $result = $collection->insertOne($document);

    if ($result->getInsertedCount() > 0) {
        redirecionar('/views/home.php');
    } else {
        echo "<script>alert('Não foi possível cadastrar este produto');</script>";
        redirecionar('/views/register/registerItem.php');
    }
}

function redirecionar($url) {
    echo "<script>window.location.href='$url';</script>";
    exit();
}

function converterParaPonto($valor) {
    return str_replace(',', '.', $valor);
}
?>