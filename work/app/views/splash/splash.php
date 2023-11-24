<?php
session_start(); 

if (!isset($_SESSION["username"])) {
    header("HTTP/1.1 302 Found");
    header("Location: /views/login.php");
    exit;
}

$nomeUsuario = $_SESSION["username"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="3;url=/views/home.php">
    <title>Carregando...</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/styles/transition/splash.css">
</head>

<body>
    <div class="sound-wave">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
</body>

</html>