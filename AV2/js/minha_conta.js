document.addEventListener('DOMContentLoaded', function () {
    carregarAcomodacoes();
    carregarAulas();
    carregarExperiencias();
});

function carregarAcomodacoes() {
    fetch('../php/minhas_reservas.php?tipo=acomodacoes')
        .then(r => r.json())
        .then(dados => {
            const tbody = document.getElementById('listaAcomodacoes');

            if (dados.length === 0) {
                tbody.innerHTML = '<tr><td colspan="6" class="text-center">Nenhuma reserva encontrada</td></tr>';
                return;
            }

            tbody.innerHTML = '';
            dados.forEach(res => {
                tbody.innerHTML += `
                    <tr>
                        <td>${res.id}</td>
                        <td>${res.nome_acomodacao}</td>
                        <td>${res.data_inicio}</td>
                        <td>${res.data_fim}</td>
                        <td>R$ ${res.valor_total}</td>
                        <td>${res.metodo_pagamento} (${res.parcelas}x)</td>
                    </tr>
                `;
            });
        });
}

function carregarAulas() {
    fetch('../php/minhas_reservas.php?tipo=aulas')
        .then(r => r.json())
        .then(dados => {
            const tbody = document.getElementById('listaAulas');

            if (dados.length === 0) {
                tbody.innerHTML = '<tr><td colspan="4" class="text-center">Nenhuma reserva encontrada</td></tr>';
                return;
            }

            tbody.innerHTML = '';
            dados.forEach(res => {
                tbody.innerHTML += `
                    <tr>
                        <td>${res.id}</td>
                        <td>${res.nome_aula}</td>
                        <td>${res.quantidade}</td>
                        <td>R$ ${res.valor_total}</td>
                    </tr>
                `;
            });
        });
}

function carregarExperiencias() {
    fetch('../php/minhas_reservas.php?tipo=experiencias')
        .then(r => r.json())
        .then(dados => {
            const tbody = document.getElementById('listaExperiencias');

            if (dados.length === 0) {
                tbody.innerHTML = '<tr><td colspan="4" class="text-center">Nenhuma reserva encontrada</td></tr>';
                return;
            }

            tbody.innerHTML = '';
            dados.forEach(res => {
                tbody.innerHTML += `
                    <tr>
                        <td>${res.id}</td>
                        <td>${res.nome_experiencia}</td>
                        <td>${res.quantidade}</td>
                        <td>R$ ${res.valor_total}</td>
                    </tr>
                `;
            });
        });
}
