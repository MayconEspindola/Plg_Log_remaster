<?php

session_start();

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/EnvironmentSettings.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nome']) && isset($_POST['senha'])) {
        $name = $_POST['nome'];
        $senha = $_POST['senha'];

        $envSettings = new \work\config\EnvironmentSettings();
        $env = $envSettings->obterConfiguracoes();

        $database = \work\config\Database::getConnection();
        $collectionName = $env['DATABASE']['collectionA2'];
        $collection = $database->selectCollection($collectionName);

        // Buscar usuário no MongoDB
        $user = $collection->findOne(['username' => $name]);

        if ($user) {
            $senhaArmazenada = $user['senha'];
            $salt = $user['salt'];

            if (password_verify($senha . $salt, $senhaArmazenada)) {
                $_SESSION["username"] = $name;
                header('Location: /views/splash/splash.php');
                exit();
            } else {
                $error_message = 'Usuário ou senha incorretos.';
                header('Location: /views/login.php?error=1');
                exit();
            }
        } else {
            $error_message = 'Usuário não encontrado.';
            header('Location: /views/login.php?error=2');
            exit();
        }
    }
}
?>