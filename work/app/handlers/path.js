const destination = "";

const navigation = {
    cadastro: () => {
        window.location.href = "/views/register/register.php";
    },
    movimentacaoProdutos: () => {
        window.location.href = "/views/transition/traffic.php";
    },
    cadCliente: () => {
        window.location.href = "/views/register/cliente.php";
    },
    cadProduto: () => {
        window.location.href = "/views/register/registerItem.php";
    },
    home: () => {
        window.location.href = "/views/home.php";
    },
    gerenciamentoDados: () => {
        window.location.href = "/views/exibicao.php";
    },
};

if (navigation.hasOwnProperty(destination)) {
    window.location.href = navigation[destination];
}
