<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/EnvironmentSettings.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    cadastrarProduto();
}

function cadastrarProduto()
{
    try {
        $envSettings = new \work\config\EnvironmentSettings();
        $env = $envSettings->obterConfiguracoes();

        $database = \work\config\Database::getConnection();

        $collectionName = $env['DATABASE']['collectionA1'];

        $collectionFornecedor = $database->selectCollection($collectionName);

        $notaFiscal = isset($_POST["invoice"]) ? $_POST["invoice"] : '';
        $codigo = isset($_POST["codigo"]) ? $_POST["codigo"] : '';
        $modelo = isset($_POST["modelo"]) ? $_POST["modelo"] : '';
        $descricao = isset($_POST["descricao"]) ? $_POST["descricao"] : '';
        $altura = isset($_POST["altura"]) ? $_POST["altura"] : '';
        $largura = isset($_POST["largura"]) ? $_POST["largura"] : '';
        $comprimento = isset($_POST["comprimento"]) ? $_POST["comprimento"] : '';
        $peso = isset($_POST["peso"]) ? $_POST["peso"] : '';
        $quantidade = isset($_POST["quantidade"]) ? $_POST["quantidade"] : '';
        $valorUnitario = isset($_POST["valorUnitario"]) ? $_POST["valorUnitario"] : '';
        $valorTotal = isset($_POST["valorTotal"]) ? $_POST["valorTotal"] : '';

        if (dadosValidos($codigo, $modelo, $altura, $largura, $comprimento, $peso, $quantidade, $valorUnitario, $valorTotal)) {
            if (codigoDuplicado($collectionFornecedor, $notaFiscal, $codigo)) {
                echo "Código duplicado. Por favor, insira um código único.";
            } else {
                $produto = [
                    'codigo' => $codigo,
                    'modelo' => $modelo,
                    'descricao' => $descricao,
                    'altura' => $altura,
                    'largura' => $largura,
                    'comprimento' => $comprimento,
                    'peso' => $peso,
                    'quantidade' => $quantidade,
                    'valorUnitario' => $valorUnitario,
                    'valorTotal' => $valorTotal,
                ];

                $filtro = ['notaFiscal' => $notaFiscal];
                $atualizacao = ['$addToSet' => ['produtos' => $produto]];

                $result = $collectionFornecedor->updateOne($filtro, $atualizacao);

                if ($result->getModifiedCount() === 0) {
                    echo "Nota fiscal não encontrada. Por favor, verifique a nota fiscal e tente novamente.";
                } else {
                    redirecionar('/views/register/registerItem.php');
                }
            }
        } else {
            echo "Dados inválidos. Por favor, preencha todos os campos.";
        }
    } catch (\Exception $e) {
        echo "Não foi possível cadastrar o produto. Por favor, tente novamente.";
    }
}

function getdados(){
    
}
function dadosValidos($codigo, $modelo, $altura, $largura, $comprimento, $peso, $quantidade, $valorUnitario, $valorTotal)
{
    // Adicione validações conforme necessário
    return !empty($codigo) && !empty($modelo) && !empty($altura) && !empty($largura)
        && !empty($comprimento) && !empty($peso) && !empty($quantidade)
        && !empty($valorUnitario) && !empty($valorTotal);
}

function codigoDuplicado($collection, $notaFiscal, $codigo)
{
    $filtro = ['notaFiscal' => $notaFiscal, 'produtos.codigo' => $codigo];
    $resultado = $collection->findOne($filtro);

    return ($resultado !== null);
}

function redirecionar($url)
{
    header("Location: $url");
    exit();
}
?>