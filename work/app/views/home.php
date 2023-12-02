<?php
    include_once("../composition/header.php"); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PLG LOG - Home</title>
</head>
<body>
    
</body>
</html>
<article>
    <div class="btns-sect text-center d-flex justify-content-center align-items-center vh-100">
        <div class="d-grid gap-2 small">
            <h6> Bem vindo! <?php echo $nomeUsuario; ?></h6>
            <button class="btn btn-primary" type="button" onclick="navigation.cadastro()">Cadastro</button>
            <button class="btn btn-primary" type="button" onclick="navigation.movimentacaoProdutos()">Movimentação de Produto</button>
            <button class="btn btn-primary" type="button" onclick="navigation.gerenciamentoDados()">Gerenciamento de Dados</button>
        </div>
    </div>
</article>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous">
</script>
</body>
</html>
