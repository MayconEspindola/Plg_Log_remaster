<?php

namespace work\controllers;

session_start();

use work\config\EnvironmentSettings;
use work\config\Database;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $envSettings = new EnvironmentSettings();
    $env = $envSettings->obterConfiguracoes();

    $database = Database::getConnection();
    $collectionName = $env['DATABASE']['collectionA1'];
    $collection = $database->selectCollection($collectionName);
    $notaFiscal = $_POST["invoice"];

    if (notaFiscalDuplicada($collection, $notaFiscal)) {
        echo "Nota fiscal duplicada. Por favor, insira uma nota fiscal única.";
        exit();
    }

    $formData = [
        "notaFiscal" => $notaFiscal,
        "dataEmissao" => $_POST["dataEmissao"],
        "nomeFornecedor" => $_POST["nomeFornecedor"],
        "cnpjFornecedor" => $_POST["cnpjFornecedor"],
        "logradouro" => $_POST["Logradouro"],
        "cidade" => $_POST["cidade"],
        "estado" => $_POST["estado"],
        "cep" => $_POST["cep"],
    ];

    $formFornecedor = new FormFornecedor($formData);
    $result = $collection->insertOne($formFornecedor);

    header("Location: /views/register/registerItem.php");
    exit();
}

function notaFiscalDuplicada($collection, $notaFiscal) {
    $existingForm = $collection->findOne(["notaFiscal" => $notaFiscal]);
    return ($existingForm !== null);
}

class FormFornecedor {
    private string $notaFiscal;
    private string $dataEmissao;
    private string $nomeFornecedor;
    private string $cnpjFornecedor;
    private string $logradouro;
    private string $cidade;
    private string $estado;
    private string $cep;

    public function __construct(array $formData) {
        foreach ($formData as $key => $value) {
            $this->$key = $value;
        }
    }

    // Métodos mágicos para getter e setter
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