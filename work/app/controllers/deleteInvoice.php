<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../config/EnvironmentSettings.php';

$envSettings = new \app\config\EnvironmentSettings();
$env = $envSettings->obterConfiguracoes();

handleRequest();

function handleRequest() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);
        processPostRequest($data);
    } else {
        http_response_code(405);
        echo json_encode(['error' => 'Método não permitido.']);
    }
}

function processPostRequest($data) {
    if (isset($data['notaFiscal'])) {
        $collectionName = $GLOBALS['env']['DATABASE']['collectionA1'];
        $filter = ['notaFiscal' => $data['notaFiscal']];
        deleteDocument($collectionName, $filter);
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Nota fiscal não fornecida.']);
    }
}

function deleteDocument($collectionName, $filter) {
    try {
        if (\app\config\Database::deleteDocument($collectionName, $filter)) {
            http_response_code(200);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Erro ao excluir documento.']);
        }
    } catch (\RuntimeException $e) {
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
    }
}
?>