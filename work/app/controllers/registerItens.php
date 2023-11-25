<?php
session_start();

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/EnvironmentSettings.php';

$nomeUsuario = isset($_SESSION["username"]) ? $_SESSION["username"] : null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cod = $_POST['codigo'];
    $model = strtoupper($_POST['modelo']);
    $description = strtoupper($_POST['description']);
    $custo = converterParaPonto($_POST['custo']);
    $lucro = converterParaPonto($_POST['lucro']);
    $preco = converterParaPonto($_POST["preco"]);
    $altura = converterParaPonto($_POST["altura"]);
    $largura = converterParaPonto($_POST["largura"]);
    $comprimento = converterParaPonto($_POST["comprimento"]);
    $peso = converterParaPonto($_POST["peso"]);
    $notaFiscal = $_POST["notaFiscal"];
    $quantidade = $_POST["quantidade"];
    $locacao = $_POST["locacao"];
    
    $dataHoraInsercao = date('d/m/Y-H:i:s');

    $envSettings = new \app\config\EnvironmentSettings();
    $env = $envSettings->obterConfiguracoes();
    $collectionName = $env['DATABASE']['collectionA1'];

    $database = \app\config\Database::getConnection();
    $collection = $database->selectCollection($collectionName);

    $verificarNotaFiscal = $collection->findOne(['notaFiscal' => $notaFiscal]);
}

    if ($verificarNotaFiscal) {
        echo "<script>alert('Não foi possível cadastrar este produto devido a uma nota fiscal já existente');</script>";
        redirecionar('/views/register/registerItem.php');
    } else {
        $document = [
            'encarregado' => $nomeUsuario,
            'codigo' => (int) $cod,
            'modelo' => $model,
            'descricao' => $description,
            'custo' => floatval($custo),
            'lucro' => floatval($lucro),
            'preco' => floatval($preco),
            'altura' => floatval($altura),
            'largura' => floatval($largura),
            'comprimento' => floatval($comprimento),
            'peso' => floatval($peso),
            'notaFiscal' => $notaFiscal,
            'quantidade' => (int) $quantidade,
            'locacao' => $locacao,
            'dataHoraInsercao' => $dataHoraInsercao,
        ];

        $result = $collection->insertOne($document);

    if ($result->getInsertedCount() > 0) {
        redirecionar('/views/register/registerItem.php');
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
