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
    <title>PJL LOG</title>
    <link rel="icon" type="image/x-icon" href="/images/PLG-log.png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.19.0/font/bootstrap-icons.css"
        rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
        crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="/assets/style/alert_traffic.css">
    <link rel="stylesheet" type="text/css" href="/assets/style/valor_invalido.css">
    <link rel="stylesheet" type="text/css" href="/assets/style/cad.produto.css">
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

    </header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary justify-content-center navbar-light bg-light">
        <a class="navbar-brand" href="/views/home.php">
            <img src="/images/PLG-log.png" alt="Logo PLG" width="30" height="24" class="d-inline-block align-text-top">
            PLG LOG
        </a>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Introdução</a>
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