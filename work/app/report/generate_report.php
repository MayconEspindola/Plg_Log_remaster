<?php
require '/var/www/html/vendor/autoload.php';// Carregue a biblioteca PHPSpreadsheet

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Função para executar consultas SQL
function executeQuery($mysqli, $sql) {
    $result = $mysqli->query($sql);
    if ($result === false) {
        die('Erro na consulta SQL: ' . $mysqli->error);
    }
    return $result;
}

$emailRemetende = $_POST['email'];
$remetende = $_POST['remetente'];

// Estabelecer a conexão com o banco de dados
$mysqli = new mysqli("mysql", "adm_plg", "adm123", "plg_log");

// Verificar a conexão
if ($mysqli->connect_error) {
    die("Erro na conexão com o banco de dados: " . $mysqli->connect_error);
}

// Consulta SQL para obter os dados de movimentação
$sqlMovimentacao = "SELECT DISTINCT pallets.autor, pallets.codigo, pallets.data, movimentacao.movimentacao, movimentacao.pallet1, movimentacao.pallet2, movimentacao.pallet3, movimentacao.pallet4, movimentacao.pallet5, movimentacao.pallet6 FROM pallets JOIN movimentacao ON pallets.id_movimentacao = movimentacao.id";
$resultMovimentacao = executeQuery($mysqli, $sqlMovimentacao);

// Consulta SQL para obter os dados do produto
$sqlProduto = "SELECT codigo, nome, modelo, descricao, custo, lucro, preco, volume FROM produtos";
$resultProduto = executeQuery($mysqli, $sqlProduto);

// Crie uma planilha (spreadsheet) com o PHPExcel
$spreadsheet = new Spreadsheet();

// Crie uma aba (worksheet) para os dados de movimentação
$worksheetMovimentacao = $spreadsheet->createSheet();
$worksheetMovimentacao->setTitle('Movimentacao');

// Crie uma aba (worksheet) para os dados do produto
$worksheetProduto = $spreadsheet->createSheet();
$worksheetProduto->setTitle('Produto');

// Escreva os dados da movimentação na planilha
$row = 1;
$worksheetMovimentacao->setCellValue('A'.$row, 'Responsavel');
$worksheetMovimentacao->setCellValue('B'.$row, 'Codigo Pallet');
$worksheetMovimentacao->setCellValue('C'.$row, 'Data');
$worksheetMovimentacao->setCellValue('D'.$row, 'Movimentacao');
$worksheetMovimentacao->setCellValue('E'.$row, 'Pallet1');
$worksheetMovimentacao->setCellValue('F'.$row, 'Pallet2');
$worksheetMovimentacao->setCellValue('G'.$row, 'Pallet3');
$worksheetMovimentacao->setCellValue('H'.$row, 'Pallet4');
$worksheetMovimentacao->setCellValue('I'.$row, 'Pallet5');
$worksheetMovimentacao->setCellValue('J'.$row, 'Pallet6');

$row++;
while ($rowMovimentacao = $resultMovimentacao->fetch_assoc()) {
    $worksheetMovimentacao->setCellValue('A'.$row, $rowMovimentacao['autor']);
    $worksheetMovimentacao->setCellValue('B'.$row, $rowMovimentacao['codigo']);
    $worksheetMovimentacao->setCellValue('C'.$row, $rowMovimentacao['data']);
    $worksheetMovimentacao->setCellValue('D'.$row, $rowMovimentacao['movimentacao']);
    $worksheetMovimentacao->setCellValue('E'.$row, $rowMovimentacao['pallet1']);
    $worksheetMovimentacao->setCellValue('F'.$row, $rowMovimentacao['pallet2']);
    $worksheetMovimentacao->setCellValue('G'.$row, $rowMovimentacao['pallet3']);
    $worksheetMovimentacao->setCellValue('H'.$row, $rowMovimentacao['pallet4']);
    $worksheetMovimentacao->setCellValue('I'.$row, $rowMovimentacao['pallet5']);
    $worksheetMovimentacao->setCellValue('J'.$row, $rowMovimentacao['pallet6']);
    $row++;
}

// Escreva os dados do produto na planilha
$row = 1;
$worksheetProduto->setCellValue('A'.$row, 'Codigo');
$worksheetProduto->setCellValue('B'.$row, 'Nome');
$worksheetProduto->setCellValue('C'.$row, 'Modelo');
$worksheetProduto->setCellValue('D'.$row, 'Descricao');
$worksheetProduto->setCellValue('E'.$row, 'Custo');
$worksheetProduto->setCellValue('F'.$row, 'Lucro');
$worksheetProduto->setCellValue('G'.$row, 'Preco');
$worksheetProduto->setCellValue('H'.$row, 'Volume');

$row++;
while ($rowProduto = $resultProduto->fetch_assoc()) {
    $worksheetProduto->setCellValue('A'.$row, $rowProduto['codigo']);
    $worksheetProduto->setCellValue('B'.$row, $rowProduto['nome']);
    $worksheetProduto->setCellValue('C'.$row, $rowProduto['modelo']);
    $worksheetProduto->setCellValue('D'.$row, $rowProduto['descricao']);
    $worksheetProduto->setCellValue('E'.$row, $rowProduto['custo']);
    $worksheetProduto->setCellValue('F'.$row, $rowProduto['lucro']);
    $worksheetProduto->setCellValue('G'.$row, $rowProduto['preco']);
    $worksheetProduto->setCellValue('H'.$row, $rowProduto['volume']);
    $row++;
}

// Crie um arquivo XLSX
$writer = new Xlsx($spreadsheet);

$dataAtual = date('Y-m-d H:i:s');
$dataFormatada = str_replace(['-', ' ', ':'], '', $dataAtual);

// Defina o caminho para o arquivo XLSX
$caminhoRelatorioXLSX = __DIR__ . '/Relatorios/relatorio_'.$dataFormatada.'.xlsx';

// Salve o arquivo XLSX
$writer->save($caminhoRelatorioXLSX);

// Feche a conexão com o banco de dados
$mysqli->close();

// Crie uma instância do PHPMailer
$mail = new PHPMailer();

// Configurações do servidor SMTP (substitua com suas configurações)
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'etecprojetotcc1@gmail.com';
$mail->Password = 'frca uyqg swpu hqcb';
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;

// Configurações do e-mail
$mail->setFrom('etecprojetotcc1@gmail.com', 'Equipe Vanguard');
$mail->addAddress($emailRemetende, $remetende);
$mail->Subject = 'Relatorio Estoque';

// Anexe o arquivo XLSX ao e-mail
$mail->addAttachment($caminhoRelatorioXLSX);

// Corpo do e-mail
$mail->Body = 'Relatorio Estoque';

// Tente enviar o e-mail
if ($mail->send()) {
    header('Location: /src/home.php');
    exit;
} else {
    echo 'Erro ao enviar e-mail: ' . $mail->ErrorInfo;
}