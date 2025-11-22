function carregarReservasExperiencias() {
    fetch("../php/listar_reservas_experiencias.php")
        .then(r => r.json())
        .then(dados => {
            let html = "";
            dados.forEach(res => {
                html += `
                <tr>
                    <td>${res.id}</td>
                    <td>${res.nome_cliente}</td>
                    <td>${res.email_cliente}</td>
                    <td>${res.telefone_cliente}</td>
                    <td>${res.nome_experiencia}</td>
                    <td>${res.quantidade}</td>
                    <td>R$ ${res.valor_total}</td>
                    <td>
                        <a href="../php/editar_reserva_experiencia.php?id=${res.id}" class="btn btn-warning btn-sm">Editar</a>
                        <button class="btn btn-danger btn-sm" onclick="excluir(${res.id})">Excluir</button>
                    </td>
                </tr>
                `;
            });
            document.getElementById("listaExperiencias").innerHTML = html;
        });
}

carregarReservasExperiencias();

function excluir(id) {
    if (!confirm("Excluir esta reserva?")) return;
    fetch("../php/excluir_reserva_experiencia.php?id=" + id)
        .then(r => r.text())
        .then(msg => {
            alert(msg);
            carregarReservasExperiencias();
        });
}
