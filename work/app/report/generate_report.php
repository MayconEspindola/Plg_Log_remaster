<?php
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/EnvironmentSettings.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

use MongoDB\Client as MongoClient;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

function getConnectionAndCollection($collectionName) {
    $envSettings = new EnvironmentSettings();
    $env = $envSettings->obterConfiguracoes();

    $database = \app\config\Database::getConnection();

    // Verifique se as configurações do banco de dados estão definidas
    if (!isset($env['DATABASE'][$collectionName])) {
        die('Configurações de banco de dados incompletas no arquivo de ambiente.');
    }

    $collection = $database->selectCollection($env['DATABASE'][$collectionName]);

    return [$database, $collection];
}

function createSpreadsheet($title, $header) {
    $spreadsheet = new Spreadsheet();
    $worksheet = $spreadsheet->createSheet();
    $worksheet->setTitle($title);

    $row = 1;
    foreach ($header as $column => $label) {
        $worksheet->setCellValue($column.$row, $label);
    }

    return $worksheet;
}

function writeToWorksheet($worksheet, $data, $row) {
    foreach ($data as $column => $value) {
        $worksheet->setCellValue($column.$row, $value);
    }
}

function saveSpreadsheet($spreadsheet) {
    $writer = new Xlsx($spreadsheet);

    $dataAtual = date('Y-m-d H:i:s');
    $dataFormatada = str_replace(['-', ' ', ':'], '', $dataAtual);

    $caminhoRelatorioXLSX = __DIR__ . '/Relatorios/relatorio_'.$dataFormatada.'.xlsx';

    $writer->save($caminhoRelatorioXLSX);

    return $caminhoRelatorioXLSX;
}

function sendEmail($emailRemetente, $remetente, $attachmentPath) {
    $mail = new PHPMailer();

    $mail->isSMTP();
    $mail->Host = $_ENV['MAIL']['smtp_host'];
    $mail->SMTPAuth = true;
    $mail->Username = $_ENV['MAIL']['smtp_username'];
    $mail->Password = $_ENV['MAIL']['smtp_password'];
    $mail->SMTPSecure = $_ENV['MAIL']['smtp_encryption'];
    $mail->Port = $_ENV['MAIL']['smtp_port'];

    $mail->setFrom($_ENV['MAIL']['from_email'], $_ENV['MAIL']['from_name']);
    $mail->addAddress($emailRemetente, $remetente);
    $mail->Subject = 'Relatorio Estoque';

    $mail->addAttachment($attachmentPath);

    $mail->Body = 'Relatorio Estoque';

    if ($mail->send()) {
        return true;
    } else {
        return 'Erro ao enviar e-mail: ' . $mail->ErrorInfo;
    }
}

// Obter dados do MongoDB
list($database, $collectionA1) = getConnectionAndCollection('collectionA1');
$resultProduto = executeQuery($collectionA1);

// Criar planilha e escrever dados
$spreadsheet = new Spreadsheet();

$headerProduto = [
    'A' => 'Encarregado',
    'B' => 'Codigo',
    'C' => 'Modelo',
    'D' => 'Descricao',
    'E' => 'Custo',
    'F' => 'Lucro',
    'G' => 'Preco',
    'H' => 'Altura',
    'I' => 'Largura',
    'J' => 'Comprimento',
    'K' => 'Peso',
    'L' => 'Nota Fiscal',
    'M' => 'Quantidade',
    'N' => 'Locacao',
    'O' => 'Data e Hora de Insercao',
];

$worksheetProduto = createSpreadsheet('Estoque', $headerProduto);

$row = 2;
foreach ($resultProduto as $produto) {
    writeToWorksheet($worksheetProduto, $produto, $row);
    $row++;
}

// Salvar planilha
$caminhoRelatorioXLSX = saveSpreadsheet($spreadsheet);

// Envio por email
$resultEmail = sendEmail($_POST['email'], $_POST['remetente'], $caminhoRelatorioXLSX);

if ($resultEmail === true) {
    header('Location: /src/home.php');
    exit;
} else {
    echo $resultEmail;
}
