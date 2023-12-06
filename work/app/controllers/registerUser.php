<?php
namespace work\controllers;

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/EnvironmentSettings.php';

class UsuarioController
{
    public function cadastrarUsuario($nome, $senha)
    {
        try {
            $envSettings = new EnvironmentSettings();
            $env = $envSettings->obterConfiguracoes();

            $database = Database::getConnection();

            $collectionName = $env['DATABASE']['collectionA2'];
            $collection = $database->selectCollection($collectionName);

            $existingUser = $collection->findOne(['username' => $nome]);

            if ($existingUser) {
                echo "<script>alert('Nome de usuário já está em uso');window.location.href='/views/cadastro.html'</script>";
            } else {
                $salt = bin2hex(random_bytes(16));

                $senhaComSalt = $senha . $salt;
                $senhaHash = password_hash($senhaComSalt, PASSWORD_BCRYPT);

                $document = [
                    'senha' => $senhaHash,
                    'salt' => $salt,
                    'username' => $nome,
                    'privilegio' => 1,
                ];

                Database::insertDocument($collectionName, $document);

                echo "<script>window.location.href='/views/login.php'</script>";
            }
        } catch (\Exception $e) {
            echo "<script>alert('Não foi possível cadastrar esse usuário');window.location.href='/views/cadastro.html'</script>";
        }
    }
}

// Exemplo de uso:
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];

    $usuarioController = new UsuarioController();
    $usuarioController->cadastrarUsuario($nome, $senha);
}
?>