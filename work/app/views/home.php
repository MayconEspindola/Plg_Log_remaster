<?php
    include_once("../composition/header.php"); 
?>


    <link rel="stylesheet" href="/styles/paginas/home.css">

    <article>

        <div class="d-grid">
            <h6> Bem vindo! <?php echo $nomeUsuario; ?></h6>
            <button class="btn btn-primary" type="button" onclick="navigation.movimentacaoProdutos()">Cadastro</button>
            <button class="btn btn-primary" type="button" onclick="navigation.gerenciamentoDados()">Gerenciamento de Dados</button>
        </div>

        </article>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
                crossorigin="anonymous">
</script>
