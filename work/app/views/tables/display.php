<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../config/EnvironmentSettings.php';
include_once("../../composition/header.php");

$envSettings = new \work\config\EnvironmentSettings();
$env = $envSettings->obterConfiguracoes();

$database = \work\config\Database::getConnection();

if ($database !== null) {
    exibirFornecedores($database);
} else {
    echo "Erro ao conectar ao MongoDB.";
}

function exibirFornecedores($database) {
    global $env;

    $collectionName = $env['DATABASE']['collectionA1'];
    $result = \work\config\Database::getResultFromQuery($collectionName);

    echo "<h6>Fornecedores</h6>";
    if ($result !== null) {
        echo "<table class='table table-dark table-striped'>
                <thead>
                    <tr>
                        <th scope='col'>Nota Fiscal</th>
                        <th scope='col'>Data de Emissão</th>
                        <th scope='col'>Nome do Fornecedor</th>
                        <th scope='col'>CNPJ do Fornecedor</th>
                        <th scope='col'>Logradouro</th>
                        <th scope='col'>Cidade</th>
                        <th scope='col'>Estado</th>
                        <th scope='col'>CEP</th>
                        <th scope='col'>Ações</th>
                    </tr>
                </thead>
                <tbody>";

        foreach ($result as $row) {
            exibirFornecedor($row);
        }

        echo "</tbody></table>";
    } else {
        echo "Erro na consulta de Fornecedores.";
    }
}

function exibirFornecedor($row) {
    echo "<tr>";
    echo "<td>{$row['notaFiscal']}</td>";
    echo "<td>{$row['dataEmissao']}</td>";
    echo "<td>{$row['nomeFornecedor']}</td>";
    echo "<td>{$row['cnpjFornecedor']}</td>";
    echo "<td>{$row['logradouro']}</td>";
    echo "<td>{$row['cidade']}</td>";
    echo "<td>{$row['estado']}</td>";
    echo "<td>{$row['cep']}</td>";
    echo "<td>
            <button type='button' class='btn btn-info' onclick='exibirDetalhes(\"{$row['notaFiscal']}\")'>Detalhes</button>
            <button type='button' class='btn btn-warning' onclick='editarRegistro(\"{$row['notaFiscal']}\")'>Editar</button>
            
            <!-- Formulário de exclusão -->
            <form method='post' action='/../../controllers/deleteInvoice.phpp'>
                <input type='hidden' name='notaFiscal' value='{$row['notaFiscal']}'>
                <button type='submit' class='btn btn-danger'>Excluir</button>
            </form>
          </td>";
    echo "</tr>";
}

// Verifica se a nota fiscal foi enviada via POST para excluir
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['notaFiscal'])) {
    $notaFiscalParaExcluir = $_POST['notaFiscal'];

    // Realiza a exclusão no arquivo PHP específico
    require_once('../../controllers/excluir_nota_fiscal.php');
    excluirNotaFiscal($notaFiscalParaExcluir);
}
?>

<script>
    function exibirDetalhes(notaFiscal) {
        window.location.href = '/views/tables/detalhes.php?notaFiscal=' + encodeURIComponent(notaFiscal);
    }

    function editarRegistro(codigo) {
        // Adicione o redirecionamento ou lógica de edição conforme necessário
        alert('Editar Registro com Código: ' + codigo);
    }
</script>