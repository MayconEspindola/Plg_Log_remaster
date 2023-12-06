function calcPrice() {
    const custoInput = document.getElementById("floatingCusto");
    const lucroInput = document.getElementById("floatingLucro");
    const pprecoValue = document.getElementById("pprecoValue");
    const pprecoHidden = document.getElementById("pprecoHidden");

    const custo = parseFloat(custoInput.value);
    const lucro = parseFloat(lucroInput.value);

    if (!isNaN(custo) && !isNaN(lucro)) {
        const preco = custo + (custo * (lucro / 100));
        pprecoValue.textContent = preco.toFixed(2);
        pprecoHidden.value = preco.toFixed(2);
    }
}
