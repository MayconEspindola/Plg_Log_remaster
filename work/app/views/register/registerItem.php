<?php include_once("../../composition/header.php"); ?>

<div class="page container-sm">
    <form method="POST" class="formCadastro" action="/controllers/classProduct.php">
        <h1>Cadastro Produto</h1>
        <p>Digite os seus dados de acesso no campo abaixo.</p>

        <!-- Nota Fiscal -->
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="inputinvoice" placeholder="Nota Fiscal" name="invoice" maxlength="9" required>
            <label for="inputinvoice">Nota Fiscal:</label>
        </div>
        
        <!-- Código -->
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="inputCodigo" placeholder="Código" name="codigo" maxlength="12" required>
            <label for="inputCodigo">Código:</label>
        </div>
        
        <!-- Modelo -->
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="inputmodelo" placeholder="Modelo" name="modelo" required>
            <label for="inputmodelo">Modelo:</label>
        </div>

        <div class="form-floating">
            <textarea class="form-control" placeholder="Descrição" id="floatingTextarea" name="description" maxlength="255"></textarea>
            <label for="floatingTextarea">Descrição</label><br>
        </div>

        <!-- Altura -->
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="inputAltura" placeholder="Altura" name="altura" required>
            <label for="inputAltura">Altura (cm):</label>
        </div>

        <!-- Largura -->
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="inputLargura" placeholder="Largura" name="largura" required>
            <label for="inputLargura">Largura (cm):</label>
        </div>

        <!-- Comprimento-->
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="inputComprimento" placeholder="Comprimento" name="comprimento" required>
            <label for="inputComprimento">Comprimento (cm):</label>
        </div>

        <!-- Peso -->
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="inputPeso" placeholder="Peso" name="peso" required>
            <label for="inputPeso">Peso (kg):</label>
        </div>

        <!-- Quantidade -->
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="inputQuantidade" placeholder="Quantidade" name="quantidade" required>
            <label for="inputQuantidade">Quantidade:</label>
        </div>

        <!-- Valor Unitário -->
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="inputValorUnitario" placeholder="Valor Unitário" name="valorUnitario" required>
            <label for="inputValorUnitario">Valor Unitário:</label>
        </div>

        <!-- Valor Total -->
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="inputValorTotal" placeholder="Valor Total" name="valorTotal" required>
            <label for="inputValorTotal">Valor Total:</label>
        </div>

        <hr>

        <div class="d-grid gap-2 d-md-block text-center d-flex justify-content-center align-items-center">
            <input type="submit" value="Cadastrar" class="btn btn-danger btn-lg" id="cadastro" />
        </div>
    </form>
</div>

<script src="/handlers/valueCalculation.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
