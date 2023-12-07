<?php
include_once("../../composition/header.php");
?>
<link rel="stylesheet" href="/styles/paginas/traffic.css">
<article id="selectionTraffic">
    <div>
        <div class="d-grid">
            <button class="btn1" onclick="invoiceEntry()">Entrada</button>
            <button class="btn2" type="button" onclick="invoiceExit()">Saída</button>
            <input type="hidden" value="0" id="movimentacao-hidden">
        </div>
    </div>
</article>
 


<div class="page container-sm" id='entrySection' style="display: none;">
<div class="formulario">
    <form method="POST" class="formCadastro" action="/controllers/classSupplier.php">
        <h1>Cadastro Nota Fiscal</h1>
        <!-- Nota Fiscal -->
      
            <input type="text" class="nf" id="inputinvoice" placeholder="Nota Fiscal" name="invoice" maxlength="9" required>
            <label for="inputinvoice"></label>
 
        <!-- Data de Emissão -->
            <input type="date" class="de" id="inputDataEmissao" placeholder="Data de Emissão" name="dataEmissao" required>
            <label for="inputDataEmissao"></label>
 

        <!-- Nome do Fornecedor -->
            <input type="text" class="fornecedor" id="inputNomeFornecedor" placeholder="Nome do Fornecedor" name="nomeFornecedor" required>
            <label for="inputNomeFornecedor"></label>
 
        <!-- CNPJ do Fornecedor -->
            <input type="text" class="cnpj" id="inputCnpjFornecedor" placeholder="CNPJ do Fornecedor" name="cnpjFornecedor" maxlength="14" required>
            <label for="inputCnpjFornecedor"></label>
       
        <!-- Logradouro -->
            <input type="text" class="end" id="inputLogradouro" placeholder="Logradouro" name="Logradouro" required>
            <label for="inputLogradouro"></label>
 
        <!-- Detalhes do Endereço -->
            <input type="text" class="cidade" id="inputCidade" placeholder="Cidade" name="cidade" required>
            <label for="inputCidade"></label>

 
            <input type="text" class="uf" id="inputEstado" placeholder="Estado" name="estado" required>
            <label for="inputEstado"></label>
   
 
            <input type="text" class="cep" id="inputCEP" placeholder="CEP" name="cep" maxlength="8" required>
            <label for="inputCEP"></label>
 
        
            <input type="submit" value="Proximo" class="btn4 btn-danger btn-lg" id="cadastro" />
    </form>
    </div>    
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