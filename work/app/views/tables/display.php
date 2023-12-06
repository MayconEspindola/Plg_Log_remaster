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
                    <button type='button' class='btn btn-danger' onclick='excluirRegistro(\"{$row['notaFiscal']}\")'>Excluir</button>
                  </td>";
            echo "</tr>";
        }

        echo "</tbody></table>";
    } else {
        echo "Erro na consulta de Fornecedores.";
    }
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

    function excluirRegistro(codigo) {
        // Adicione a lógica de confirmação e exclusão conforme necessário
        /*
        if (confirm('Tem certeza que deseja excluir o registro com Código ' + codigo + '?')) {
            excluirRegistroNoBanco(codigo);
        }
        */
    }
</script>
