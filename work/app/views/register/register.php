<?php
    include_once("../../composition/header.php"); 
?>

<article>
    <section class="btns-sect text-center d-flex justify-content-center align-items-center vh-100">
        <div class="d-grid gap-2">
            <button class="btn btn-primary" type="button" onclick="navigation.cadProduto()">
                <img src="/images/box.png" width="60" height="36" alt="Ícone Produto">
                Produto
            </button>
            <button class="btn btn-primary" type="submit" onclick="navigation.cadCliente()">
                <img src="/images/pessoas.png" width="60" height="36" alt="Ícone Clientes">
                Fornecedores
            </button>
        </div>
    </section>
</article>
<footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
        crossorigin="anonymous">
</script>
</body>
</html>
