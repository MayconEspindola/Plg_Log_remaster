<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../config/EnvironmentSettings.php';
include_once("../../composition/header.php");

$envSettings = new \app\config\EnvironmentSettings();
$env = $envSettings->obterConfiguracoes();

$database = \app\config\Database::getConnection();

if ($database !== null) {
    exibirProdutos($database);
} else {
    echo "Erro ao conectar ao MongoDB.";
}

function exibirProdutos($database) {
    global $env;

    $collectionName = $env['DATABASE']['collectionA1'];
    $result = \app\config\Database::getResultFromQuery($collectionName);

    if ($result !== null) {
        echo "<table class='table table-dark table-striped'>
                <thead>
                    <tr>
                        <th scope='col'>Encarregado</th>
                        <th scope='col'>Código</th>
                        <th scope='col'>Modelo</th>
                        <th scope='col'>Descrição</th>
                        <th scope='col'>Custo</th>
                        <th scope='col'>Lucro</th>
                        <th scope='col'>Preço</th>
                        <th scope='col'>Altura</th>
                        <th scope='col'>Largura</th>
                        <th scope='col'>Comprimento</th>
                        <th scope='col'>Peso</th>
                        <th scope='col'>Nota Fiscal</th>
                        <th scope='col'>Ações</th>
                    </tr>
                </thead>
                <tbody>";

        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>{$row['encarregado']}</td>";
            echo "<td>{$row['codigo']}</td>";
            echo "<td>{$row['modelo']}</td>";
            echo "<td>{$row['descricao']}</td>";
            echo "<td>{$row['custo']}</td>";
            echo "<td>{$row['lucro']}</td>";
            echo "<td>{$row['preco']}</td>";
            echo "<td>{$row['altura']}</td>";
            echo "<td>{$row['largura']}</td>";
            echo "<td>{$row['comprimento']}</td>";
            echo "<td>{$row['peso']}</td>";
            echo "<td>{$row['notaFiscal']}</td>";
            echo "<td>
                    <button type='button' class='btn btn-info' onclick='exibirDetalhes(\"{$row['notaFiscal']}\")'>Detalhes</button>
                    <button type='button' class='btn btn-warning' onclick='editarRegistro(\"{$row['notaFiscal']}\")'>Editar</button>
                    <button type='button' class='btn btn-danger' onclick='excluirRegistro(\"{$row['notaFiscal']}\")'>Excluir</button>
                  </td>";
            echo "</tr>";
        }

        echo "</tbody></table>";
    } else {
        echo "Erro na consulta de Produtos.";
    }
}
?>
<script>
    function exibirDetalhes(notaFiscal) {
        window.location.href = 'detalhes.php?notaFiscal=' + notaFiscal;
    }

    function editarRegistro(notaFiscal) {
        alert('Editar Registro com Nota Fiscal: ' + notaFiscal);
    }

    function excluirRegistro(notaFiscal) {

        /*
        if (confirm('Tem certeza que deseja excluir o registro com Nota Fiscal ' + notaFiscal + '?')) {
            excluirRegistroNoBanco(notaFiscal);
        }
        */
    }
</script>