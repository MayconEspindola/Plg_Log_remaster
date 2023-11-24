<?php
    include_once("../../composition/header.php"); 
?>
    <div class="page .container-sm">
        <form method="POST" class="formCadastro" action="/controllers/registerclients.php">
            <h1>Cadastro</h1>
            <p>Digite os seus dados de acesso no campo abaixo.</p>

            <div class="form-floating mb-3">
                <input type="text" 
                class="form-control" 
                id="floatingName" 
                placeholder="Nome" 
                name="nome"
                maxlength="255" 
                required>
                <label for="floatingName">Nome:</label>
            </div>

            <div class="text-center d-flex justify-content-center align-items-center">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" 
                    type="radio" 
                    name="inlineRadioOptions" 
                    id="radioFisico" 
                    onclick="habilitacacao()"
                    value="1"
                    required>
                    <label class="form-check-label" for="radioFisico">Físico</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" 
                    type="radio" 
                    name="inlineRadioOptions" 
                    id="radioJuridico" 
                    onclick="habilitacacao()" 
                    value="2"
                    required>
                    <label class="form-check-label" for="radioJuridico">Juridico</label>
                </div>
            </div>

            <div class="form-floating mb-3">
                <input type="text" 
                class="form-control" 
                id="inputCPF" 
                placeholder="CPF" 
                name="cpf" 
                maxlength="11" minlength="11" 
                required
                disabled>
                <label for="inputCPF">CPF:</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" 
                class="form-control" 
                id="inputCNPJ" 
                placeholder="CNPJ" 
                name="cnpj"  
                maxlength="14" minlength="14" 
                required
                disabled>
                <label for="inputCNPJ">CNPJ:</label>
            </div>

            <div class="form-floating mb-3">
                <input type="email" 
                class="form-control " 
                id="floatingEmail" 
                placeholder="name@example.com" 
                name="email" 
                required>
                <label for="floatingEmail">Email:</label>
            </div>
            <input type="submit" value="Cadastrar" class="btn btn-danger" id="cadastro" />
        </form>
    </div>

    <script src="/handlers/controlerRegister.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>
</html>