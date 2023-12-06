const inpCnpj = document.querySelector("#inputCNPJ");
const inpCpf = document.querySelector("#inputCPF");
const radioFisico = document.getElementById("radioFisico");
const radioJuridico = document.getElementById("radioJuridico");

function habilitacacao() {
    inpCnpj.disabled = radioFisico.checked;
    inpCpf.disabled = radioJuridico.checked;

    if (inpCnpj.disabled) {
        inpCnpj.value = '';
    }

    if (inpCpf.disabled) {
        inpCpf.value = '';
    }
}