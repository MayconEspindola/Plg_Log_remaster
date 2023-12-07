<?php

require_once __DIR__ . '/../config/database.php';

function excluirNotaFiscal($notaFiscal) {
    try {
        $collectionName = 'produtos'; // Substitua pelo nome da sua coleção
        $filter = ['notaFiscal' => $notaFiscal];

        $deleted = \work\config\Database::deleteDocument($collectionName, $filter);

        if ($deleted) {
            echo json_encode(['success' => true, 'message' => 'Documento excluído com sucesso.']);
            exit();
        } else {
            echo json_encode(['success' => false, 'message' => 'Nenhum documento encontrado para exclusão.']);
            exit();
        }
    } catch (\RuntimeException $e) {
        echo json_encode(['success' => false, 'message' => 'Erro ao excluir documento por nota fiscal: ' . $e->getMessage()]);
        exit();
    }
}

// Verifica se a nota fiscal foi enviada via POST para excluir
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['notaFiscal'])) {
    $notaFiscalParaExcluir = $_POST['notaFiscal'];
    excluirNotaFiscal($notaFiscalParaExcluir);
}

?>