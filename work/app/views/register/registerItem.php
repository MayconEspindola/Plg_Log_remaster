<?php
    include_once("../../composition/header.php"); 
?>

<div class="page container-sm">
    <form method="POST" class="formCadastro" action="/controllers/registerItens.php">
        <h1>Cadastro</h1>
        <p>Digite os seus dados de acesso no campo abaixo.</p>

        <!-- Código -->
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="inputCodigo" placeholder="Código" name="codigo" maxlength="12" required>
            <label for="inputCodigo">Código:</label>
        </div>

        <!-- Nota Fiscal -->
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="inputNotaFiscal" placeholder="Nota Fiscal" name="notaFiscal" maxlength="14" required>
            <label for="inputNotaFiscal">Nota Fiscal:</label>
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

        <!-- Custo -->
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingCusto" placeholder="Custo" name="custo" required>
            <label for="floatingCusto">Custo:</label>
        </div>

        <!-- Lucro -->
        <div class="form-floating mb-3">
            <input type="number" class="form-control" id="floatingLucro" placeholder="Porcentagem de Lucro" name="lucro" max="120" required>
            <label for="floatingLucro">Lucro(%):</label>
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

        <!-- Quantity -->
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="inputQuantidade" placeholder="Quantidade" name="quantidade" required>
            <label for="inputQuantidade">Quantidade:</label>
        </div>

        <!-- Location -->
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="inputLocacao" placeholder="Locação" name="locacao" required>
            <label for="inputLocacao">Locação:</label>
        </div>

        <!-- Preço -->
        <div class="form-floating mb-3">
            <p id="pprecolabel">Preço:</p>
            <span class="form-label" name="preco" id="pprecoValue">0</span>
            <input type="hidden" id="pprecoHidden" name="preco" value="0">
        </div>
        <hr>

        <div class="d-grid gap-2 d-md-block text-center d-flex justify-content-center align-items-center">
            <input type="submit" value="Cadastrar" class="btn btn-danger btn-lg" id="cadastro" />
            <input type="button" value="Calcular" onclick="calcPrice()" class="btn btn-danger btn-lg" id="calcular" />
            <a href="./register.php">
                <button type="button" class="btn btn-danger btn-lg">Voltar</button>
            </div>
    </form>
</div>

<script src="/handlers/valueCalculation.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
