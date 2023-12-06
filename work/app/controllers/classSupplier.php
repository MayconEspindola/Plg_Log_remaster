<?php

namespace work\controllers;

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/EnvironmentSettings.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $envSettings = new \work\config\EnvironmentSettings();
        $env = $envSettings->obterConfiguracoes();

        $database = \work\config\Database::getConnection();
        $collectionName = $env['DATABASE']['collectionA1'];
        $collection = $database->selectCollection($collectionName);

        $notaFiscal = $_POST["invoice"];
        
        if (notaFiscalDuplicada($collection, $notaFiscal)) {
            redirecionar("/views/transition/traffic.php");
        }

        $formData = obterFormData($_POST);

        inserirNoBancoDeDados($collection, $formData);

        redirecionar("/views/register/registerItem.php");
    } catch (\Exception $e) {
        exibirErro("Erro ao salvar as informações: " . $e->getMessage());
    }
}

function notaFiscalDuplicada($collection, $notaFiscal) {
    $filtro = ["notaFiscal" => $notaFiscal];
    $resultado = $collection->findOne($filtro);

    return ($resultado !== null);
}

function obterFormData($post) {
    return [
        "notaFiscal" => $post["invoice"],
        "dataEmissao" => $post["dataEmissao"],
        "nomeFornecedor" => $post["nomeFornecedor"],
        "cnpjFornecedor" => $post["cnpjFornecedor"],
        "logradouro" => $post["Logradouro"],
        "cidade" => $post["cidade"],
        "estado" => $post["estado"],
        "cep" => $post["cep"],
    ];
}

function inserirNoBancoDeDados($collection, $formData) {
    $result = $collection->insertOne($formData);
}

function redirecionar($url) {
    header("Location: $url");
    exit();
}

function exibirErro($mensagem) {
    echo $mensagem;
}
?>