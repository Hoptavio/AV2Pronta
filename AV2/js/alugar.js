document.addEventListener("DOMContentLoaded", function () {
    const selectAcomodacao = document.getElementById("select_acomodacao");
    const idField = document.getElementById("id_acomodacao");
    const precoField = document.getElementById("preco");
    const titulo = document.getElementById("titulo");
    const inicioEl = document.getElementById("inicio");
    const fimEl = document.getElementById("fim");
    const valorEl = document.getElementById("valor");
    const metodoEl = document.getElementById("metodo_pagamento");
    const areaPix = document.getElementById("area_pix");
    const areaCartao = document.getElementById("area_cartao");
    const parcelasEl = document.getElementById("parcelas");
    const valorParcelaEl = document.getElementById("valor_parcela");

    fetch("../php/listar_acomodacoes.php")
        .then(response => response.json())
        .then(lista => {
            let html = `<option value="">Selecione...</option>`;

            lista.forEach(a => {
                html += `<option value="${a.id}" data-preco="${a.preco}" data-nome="${a.nome}">
                            ${a.nome} — R$ ${a.preco}
                         </option>`;
            });

            selectAcomodacao.innerHTML = html;

            const params = new URLSearchParams(window.location.search);
            const idUrl = params.get('id');
            if (idUrl) {
                selectAcomodacao.value = idUrl;
                selectAcomodacao.dispatchEvent(new Event('change'));
            }
        });

    selectAcomodacao.addEventListener("change", function () {
        const op = this.selectedOptions[0];

        if (!op.value) {
            idField.value = "";
            precoField.value = "";
            titulo.textContent = "Finalizar Aluguel";
            return;
        }

        idField.value = op.value;
        precoField.value = op.getAttribute("data-preco");
        titulo.textContent = "Alugar: " + op.getAttribute("data-nome");
        calcular();
    });

    function calcular() {
        const preco = parseFloat(precoField.value);
        const inicio = new Date(inicioEl.value);
        const fim = new Date(fimEl.value);

        if (!inicioEl.value || !fimEl.value) {
            valorEl.value = "0.00";
            return;
        }

        const diff = (fim - inicio) / (1000 * 60 * 60 * 24);
        const total = diff > 0 ? (diff * preco) : 0;
        valorEl.value = total.toFixed(2);
        atualizarParcelas();
    }

    inicioEl.addEventListener("change", calcular);
    fimEl.addEventListener("change", calcular);

    function atualizarParcelas() {
        const total = parseFloat(valorEl.value);
        const parcelas = parseInt(parcelasEl.value);
        valorParcelaEl.value = (total / parcelas).toFixed(2);
    }

    parcelasEl.addEventListener("change", atualizarParcelas);

    metodoEl.addEventListener("change", function () {
        areaPix.classList.add("d-none");
        areaCartao.classList.add("d-none");

        if (this.value === "pix") {
            areaPix.classList.remove("d-none");
            parcelasEl.value = "1";
            atualizarParcelas();
        } else if (this.value === "cartao") {
            areaCartao.classList.remove("d-none");
            atualizarParcelas();
        }
    });
});
