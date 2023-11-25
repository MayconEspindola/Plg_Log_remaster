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
    $collectionName = $GLOBALS['env']['DATABASE']['collectionA1'];

    $result = \app\config\Database::getResultFromQuery($collectionName);

    if ($result !== null) {
        echo "<table class='table table-dark table-striped'>
                <thead>
                    <tr>
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
                    </tr>
                </thead>
                <tbody>";

        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>" . $row['$cod']. "</td>";
            echo "<td>" . $row['$model'] . "</td>";
            echo "<td>" . $row['$description'] . "</td>";
            echo "<td>" . $row['$custo'] . "</td>";
            echo "<td>" . $row['$lucro'] . "</td>";
            echo "<td>" . $row['$preco'] . "</td>";
            echo "<td>" . $row['$altura'] . "</td>";
            echo "<td>" . $row['$largura'] . "</td>";
            echo "<td>" . $row['$comprimento'] . "</td>";
            echo "<td>" . $row['$peso'] . "</td>";
            echo "<td>" . $row['$notaFiscal'] . "</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    }else {
        echo "Erro na consulta de Produtos.";
    }
}
?>