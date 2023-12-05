<?php
include_once("../../composition/header.php");
?>
 
<article id="selectionTraffic">
    <div class="btns-sect text-center d-flex justify-content-center align-items-center vh-100">
        <div class="d-grid gap-2 small">
            <button class="btn btn-primary" onclick="invoiceEntry()">Entrada</button>
            <button class="btn btn-primary" type="button" onclick="invoiceExit()">Saída</button>
            <input type="hidden" value="0" id="movimentacao-hidden">
        </div>
    </div>
</article>
 
<div class="page container-sm" id='entrySection' style="display: none;">
    <form method="POST" class="formCadastro" action="/controllers/formFornecedor.php">
        <h1>Cadastro Nota Fiscal</h1>
        <p>Digite os seus dados de acesso no campo abaixo.</p>
 
        <!-- Nota Fiscal -->
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="inputinvoice" placeholder="Nota Fiscal" name="invoice" maxlength="9" required>
            <label for="inputinvoice">Nota Fiscal:</label>
        </div>
 
        <!-- Data de Emissão -->
        <div class="form-floating mb-3">
            <input type="date" class="form-control" id="inputDataEmissao" placeholder="Data de Emissão" name="dataEmissao" required>
            <label for="inputDataEmissao">Data de Emissão:</label>
        </div>
 
        <!-- Fornecedor -->
        <div class="form-floating mb-3">
        <!-- Nome do Fornecedor -->
            <input type="text" class="form-control" id="inputNomeFornecedor" placeholder="Nome do Fornecedor" name="nomeFornecedor" required>
            <label for="inputNomeFornecedor">Nome do Fornecedor:</label>
        </div>
 
        <!-- CNPJ do Fornecedor -->
        <div class="form-floating mb-3">
            <input type="text" class="form-control mt-3" id="inputCnpjFornecedor" placeholder="CNPJ do Fornecedor" name="cnpjFornecedor" maxlength="14" required>
            <label for="inputCnpjFornecedor">CNPJ do Fornecedor:</label>
        </div>
       
        <!-- Logradouro -->
        <div class="form-floating mb-3">
            <input type="text" class="form-control mt-3" id="inputLogradouro" placeholder="Logradouro" name="Logradouro" required>
            <label for="inputLogradouro">Logradouro:</label>
        </div>
 
        <!-- Detalhes do Endereço -->
        <div class="form-floating mb-3">
            <input type="text" class="form-control mt-3" id="inputCidade" placeholder="Cidade" name="cidade" required>
            <label for="inputCidade">Cidade:</label>
        </div>
 
        <div class="form-floating mb-3">
            <input type="text" class="form-control mt-3" id="inputEstado" placeholder="Estado" name="estado" required>
            <label for="inputEstado">Estado:</label>
        </div>
 
        <div class="form-floating mb-3">
            <input type="text" class="form-control mt-3" id="inputCEP" placeholder="CEP" name="cep" maxlength="8" required>
            <label for="inputCEP">CEP:</label>
        </div>
 
        <div class="d-grid gap-2 d-md-block text-center d-flex justify-content-center align-items-center">
            <input type="submit" value="Proximo ->" class="btn btn-danger btn-lg" id="cadastro" />
        </div>
    </form>
</div>
 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
 
<script>
    function invoiceEntry() {
        document.getElementById('selectionTraffic').style.display = 'none';
        document.getElementById('entrySection').style.display = 'flex';
    }
 
    function invoiceExit() {
        alert('Botão Saída clicado!');
    }
</script>
 
 
</body>
</html>