<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../config/EnvironmentSettings.php';
include_once("../../composition/header.php");

function exibirInformacoesProdutos($produtos) {
    echo "<h2>Produtos</h2>";
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
                    <th scope='col'>Quantidade</th>
                    <th scope='col'>Valor Unitário</th>
                    <th scope='col'>Valor Total</th>
                </tr>
            </thead>
            <tbody>";

    foreach ($produtos as $produto) {
        echo "<tr>";
        echo "<td>{$produto->codigo}</td>";
        echo "<td>{$produto->modelo}</td>";
        echo "<td>{$produto->descricao}</td>";
        echo "<td>{$produto->altura}</td>";
        echo "<td>{$produto->largura}</td>";
        echo "<td>{$produto->comprimento}</td>";
        echo "<td>{$produto->peso}</td>";
        echo "<td>{$produto->quantidade}</td>";
        echo "<td>{$produto->valorUnitario}</td>";
        echo "<td>{$produto->valorTotal}</td>";
        echo "</tr>";
    }

    echo "</tbody></table>";
}

$notaFiscal = isset($_GET['notaFiscal']) ? $_GET['notaFiscal'] : null;

if ($notaFiscal) {
    $envSettings = new \work\config\EnvironmentSettings();
    $env = $envSettings->obterConfiguracoes();
    
    $collectionName = $env['DATABASE']['collectionA1'];
    $filter = ['notaFiscal' => $notaFiscal];

    $cursor = \work\config\Database::getResultFromQuery($collectionName, $filter);

    if ($cursor !== null) {
        foreach ($cursor as $document) {
            if (property_exists($document, 'produtos')) {
                exibirInformacoesProdutos($document->produtos);
            }
        }
    } else {
        echo "Erro na consulta de Produtos com Nota Fiscal: $notaFiscal";
    }
} else {
    echo "Nota Fiscal não fornecida.";
}
?>