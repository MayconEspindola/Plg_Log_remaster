<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../config/EnvironmentSettings.php';
include_once("../../composition/header.php");

$notaFiscal = isset($_GET['notaFiscal']) ? $_GET['notaFiscal'] : null;

if ($notaFiscal) {
    $envSettings = new \app\config\EnvironmentSettings();
    $env = $envSettings->obterConfiguracoes();
    
    $collectionName = $env['DATABASE']['collectionA1'];
    $filter = ['notaFiscal' => $notaFiscal];

    $result = \app\config\Database::getResultFromQuery($collectionName, $filter);

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
            echo "</tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "Erro na consulta de Produtos com Nota Fiscal: $notaFiscal";
    }
} else {
    echo "Nota Fiscal não fornecida.";
}
?>