<<<<<<< HEAD
=======
<?php
session_start();

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/EnvironmentSettings.php';

$nomeUsuario = isset($_SESSION["username"]) ? $_SESSION["username"] : null;
$cod = $_POST['codigo'];
$model = $_POST['modelo'];
$description = $_POST['description'];
$custo = $_POST['custo'];
$lucro = $_POST['lucro'];
$preco = $_POST["preco"];
$altura = $_POST["altura"];
$largura = $_POST["largura"];
$comprimento = $_POST["comprimento"];
$peso = $_POST["peso"];
$notaFiscal = $_POST["notaFiscal"];

$envSettings = new \app\config\EnvironmentSettings();
$env = $envSettings->obterConfiguracoes();
$collectionName = $env['DATABASE']['collectionA1'];

$database = \app\config\Database::getConnection();
$collection = $database->selectCollection($collectionName);

$verificarNotaFiscal = $collection->findOne(['notaFiscal' => $notaFiscal]);

<<<<<<< HEAD
if ($verificarNotaFiscal) {
    echo "<script>alert('Não foi possível cadastrar este produto devido a uma nota fiscal já existente');</script>";
    redirecionar('/views/register/registerItem.php');
} else {
    $document = [
        'encarregado' => $nomeUsuario,
        'codigo' => (int) $cod,
        'modelo' => htmlspecialchars($model),
        'descricao' => htmlspecialchars($description),
        'custo' => floatval($custo),
        'lucro' => floatval($lucro),
        'preco' => floatval($preco),
        'altura' => floatval($altura),
        'largura' => floatval($largura),
        'comprimento' => floatval($comprimento),
        'peso' => floatval($peso),
        'notaFiscal' => $notaFiscal,
    ];
=======
    $verificarNotaFiscal = $collection->findOne(['notaFiscal' => $notaFiscal]);
}
<<<<<<< HEAD
>>>>>>> 725f0fb ( No ramo Plg_Log_remaster-Miler)
=======
>>>>>>> e50af20d38dfea7b7ac374c2cd6411b2d2208a73

    $result = $collection->insertOne($document);

    if ($result->getInsertedCount() > 0) {
        redirecionar('/views/register/registerItem.php');
    } else {
<<<<<<< HEAD
=======
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
>>>>>>> e50af20d38dfea7b7ac374c2cd6411b2d2208a73
        echo "<script>alert('Não foi possível cadastrar este produto');</script>";
        redirecionar('/views/register/registerItem.php');
    }
}


function redirecionar($url) {
    echo "<script>window.location.href='$url';</script>";
    exit();
}
<<<<<<< HEAD
?>
>>>>>>> 893fe27 (main)
=======

function converterParaPonto($valor) {
    return str_replace(',', '.', $valor);

}
?>
<<<<<<< HEAD
>>>>>>> 725f0fb ( No ramo Plg_Log_remaster-Miler)
=======
>>>>>>> e50af20d38dfea7b7ac374c2cd6411b2d2208a73
