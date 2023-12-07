<?php
session_start();

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/EnvironmentSettings.php';

if (isset($_SESSION["username"])) {
    $nomeUsuario = $_SESSION["username"];
} else {
    redirecionar('/views/login.php');
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST['nome'];
    $tipo = $_POST['inlineRadioOptions'];
    $CPF = isset($_POST['cpf']) ? $_POST['cpf'] : null;
    $cnpj = isset($_POST['cnpj']) ? $_POST['cnpj'] : null;
    $email = $_POST['email'];

    $envSettings = new \app\config\EnvironmentSettings();
    $env = $envSettings->obterConfiguracoes();
    $collectionName = $env['DATABASE']['collectionA2'];

    $database = \app\config\Database::getConnection();
    $collection = $database->selectCollection($collectionName);

    $verificarNome = $collection->findOne(['nome' => $nome]);

    if ($verificarNome) {
        echo "<script>alert('Não foi possível cadastrar este cliente devido a um nome já existente');</script>";
        redirecionar('/views/register/registerClient.php');
    } else {
        $document = [
            'autor' => $nomeUsuario,
            'nome' => htmlspecialchars($nome),
            'tipo' => $tipo,
            'cpf' => $CPF,
            'cnpj' => $cnpj,
            'email' => $email,
        ];

        $result = $collection->insertOne($document);

        if ($result->getInsertedCount() > 0) {
            redirecionar('/views/home.php');
        } else {
            echo "<script>alert('Não foi possível cadastrar este cliente');</script>";
            redirecionar('/views/home.php');
        }
    }
} else {
    redirecionar('/views/register/registerClient.php');
}

function redirecionar($url)
{
    echo "<script>window.location.href='$url';</script>";
    exit();
}
?>