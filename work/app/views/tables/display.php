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

    echo "<h6>Produtos</h6>";
    if ($result !== null) {
        echo "<table class='table table-dark table-striped'>
                <thead>
                    <tr>
                        <th scope='col'>Código</th>
                        <th scope='col'>Modelo</th>
                        <th scope='col'>Descrição</th>
                        <th scope='col'>Altura</th>
                        <th scope='col'>Largura</th>
                        <th scope='col'>Comprimento</th>
                        <th scope='col'>Peso</th>
                        <th scope='col'>Data e Hora de Inserção</th>
                        <th scope='col'>Ações</th>
                    </tr>
                </thead>
                <tbody>";

        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>{$row['codigo']}</td>";
            echo "<td>{$row['modelo']}</td>";
            echo "<td>{$row['descricao']}</td>";
            echo "<td>{$row['altura']}</td>";
            echo "<td>{$row['largura']}</td>";
            echo "<td>{$row['comprimento']}</td>";
            echo "<td>{$row['peso']}</td>";
            echo "<td>{$row['dataHoraInsercao']}</td>";
            echo "<td>
                    <button type='button' class='btn btn-info' onclick='exibirDetalhes(\"{$row['codigo']}\")'>Detalhes</button>
                    <button type='button' class='btn btn-warning' onclick='editarRegistro(\"{$row['codigo']}\")'>Editar</button>
                    <button type='button' class='btn btn-danger' onclick='excluirRegistro(\"{$row['codigo']}\")'>Excluir</button>
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
    function exibirDetalhes(codigo) {
        // Adicione o redirecionamento ou lógica de detalhes conforme necessário
        alert('Detalhes do Registro com Código: ' + codigo);
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
