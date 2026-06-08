$(document).ready(function () {
    if ($('#tabela').length) {
        $('#tabela').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/pt_br.json',
            },
        });
    }
});

function somenteNumeros(valor) {
    return valor.replace(/\D/g, '');
}

function aplicarMascaraTelefone(input) {
    let valor = somenteNumeros(input.value).slice(0, 11);
    if (valor.length <= 10) {
        valor = valor.replace(/(\d{2})(\d)/, '($1) $2');
        valor = valor.replace(/(\d{4})(\d)/, '$1-$2');
    } else {
        valor = valor.replace(/(\d{2})(\d)/, '($1) $2');
        valor = valor.replace(/(\d{5})(\d)/, '$1-$2');
    }
    input.value = valor;
}

function aplicarMascaraCpf(input) {
    let valor = somenteNumeros(input.value).slice(0, 11);
    valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
    valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
    valor = valor.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
    input.value = valor;
}

function aplicarMascaraCnpj(input) {
    let valor = somenteNumeros(input.value).slice(0, 14);
    valor = valor.replace(/^(\d{2})(\d)/, '$1.$2');
    valor = valor.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3');
    valor = valor.replace(/\.(\d{3})(\d)/, '.$1/$2');
    valor = valor.replace(/(\d{4})(\d)/, '$1-$2');
    input.value = valor;
}

function aplicarMascaraPreco(input) {
    let valor = somenteNumeros(input.value);
    valor = (parseInt(valor || '0', 10) / 100).toFixed(2);
    input.value = valor.replace('.', ',').replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}

document.addEventListener('input', function (event) {
    if (event.target.classList.contains('mascara-telefone')) aplicarMascaraTelefone(event.target);
    if (event.target.classList.contains('mascara-cpf')) aplicarMascaraCpf(event.target);
    if (event.target.classList.contains('mascara-cnpj')) aplicarMascaraCnpj(event.target);
    if (event.target.classList.contains('mascara-preco')) aplicarMascaraPreco(event.target);
});
