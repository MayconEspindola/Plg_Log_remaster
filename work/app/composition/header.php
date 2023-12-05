<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("HTTP/1.1 302 Found");
    header("Location: /views/login.php");
    exit;
} else {
    $nomeUsuario = $_SESSION["username"];
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PLG LOG</title>
    <link rel="icon" type="image/x-icon" href="/images/PLG-log.png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.19.0/font/bootstrap-icons.css"
        rel="stylesheet">

        <link rel="stylesheet" href="/styles/paginas/header.css">

    <script src="/handlers/path.js"></script>
    <script src="/assets/js/controller-soma-sub.js"></script>
    <script src="/handlers/InactivityCheckerjs"></script>
    <script>
        function showInputFields() {
            var form = document.getElementById("reportForm");
            form.style.display = "block";
        }
        </script>
</head>

<body>
    <header>

        <nav class="navbar">
    
            <div class="logo">
                <a href="/views/home.php">
                    <img src="/images/PLG-log.png" alt="Logo PLG">
                </a>
            </div>
    
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/views/introducao.php">Introdução</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/views/home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Perfil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="showInputFields()">
                        Gerar Relatório
                    </a>
                    <form id="reportForm" action="/report/generate_report.php" method="post" onsubmit="return confirmInput()" style="display: none;">
                        <input type="text" name="email" placeholder="E-mail" required>
                        <input type="text" name="remetente" placeholder="Remetente" required>
                        <button type="submit">Confirmar</button>
                    </form>
                </li>
                <li class="nav-item">
                    <form action="/controllers/logout.php" method="post">
                        <button type="submit" class="btn btn-link">
                            <i class="bi bi-box-arrow-right"></i> Sair
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
    </header>