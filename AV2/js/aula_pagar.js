document.addEventListener("DOMContentLoaded", function () {
    console.log("aula_pagar.js loaded");

    const selectAula = document.getElementById("select_aula");
    const idField = document.getElementById("id_aula");
    const quantidadeEl = document.getElementById("quantidade");
    const totalEl = document.getElementById("total");
    const form = document.getElementById("formAula");
    const titulo = document.getElementById("titulo");

    const metodoEl = document.getElementById("metodo_pagamento");
    const areaPix = document.getElementById("area_pix");
    const areaCartao = document.getElementById("area_cartao");
    const parcelasEl = document.getElementById("parcelas");
    const valorParcelaEl = document.getElementById("valor_parcela");

    console.log("Fetching aulas...");
    fetch("../php/listar_aulas.php")
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(lista => {
            let html = `<option value="">Selecione...</option>`;
            lista.forEach(item => {
                html += `<option value="${item.id}" data-preco="${item.preco}" data-nome="${item.nome}">${item.nome} — R$ ${item.preco}</option>`;
            });
            selectAula.innerHTML = html;

            const params = new URLSearchParams(window.location.search);
            const id = params.get('id');
            if (id) {
                selectAula.value = id;
                const event = new Event('change');
                selectAula.dispatchEvent(event);
            }
        })
        .catch(error => {
            console.error("Erro ao carregar aulas:", error);
            selectAula.innerHTML = `<option value="">Erro ao carregar opções</option>`;
            alert("Erro ao carregar as aulas. Por favor, recarregue a página.");
        });

    selectAula.addEventListener("change", function () {
        const op = this.selectedOptions[0];

        if (!op.value) {
            idField.value = "";
            titulo.textContent = "Finalizar Reserva de Aula";
            totalEl.value = "";
            return;
        }

        idField.value = op.value;
        const nome = op.getAttribute("data-nome");
        titulo.textContent = "Finalizar reserva de aula: " + nome;
        atualizarTotal();
    });

    function getPrecoSelecionado() {
        const opcao = selectAula.selectedOptions[0];
        const preco = opcao ? parseFloat(opcao.getAttribute("data-preco")) : 0;
        return isNaN(preco) ? 0 : preco;
    }

    function atualizarTotal() {
        const preco = getPrecoSelecionado();
        const qtd = parseInt(quantidadeEl.value, 10);

        if (!preco || isNaN(qtd) || qtd < 1) {
            totalEl.value = "";
            atualizarParcelas();
            return;
        }

        const total = preco * qtd;
        totalEl.value = total.toFixed(2);

        atualizarParcelas();
    }

    function atualizarParcelas() {
        const total = parseFloat(totalEl.value.replace(",", "."));
        if (isNaN(total) || total <= 0) {
            valorParcelaEl.value = "0.00";
            return;
        }

        const parcelas = parseInt(parcelasEl.value);
        valorParcelaEl.value = (total / parcelas).toFixed(2);
    }

    metodoEl.addEventListener("change", function () {

        areaPix.classList.add("d-none");
        areaCartao.classList.add("d-none");

        if (this.value === "pix") {
            areaPix.classList.remove("d-none");
            parcelasEl.value = "1";
            atualizarParcelas();
        }

        if (this.value === "cartao") {
            areaCartao.classList.remove("d-none");
            atualizarParcelas();
        }
    });

    parcelasEl.addEventListener("change", atualizarParcelas);

    selectAula.addEventListener("change", atualizarTotal);
    quantidadeEl.addEventListener("input", atualizarTotal);



    atualizarTotal();

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const preco = getPrecoSelecionado();
        const qtdVal = parseInt(quantidadeEl.value, 10);

        if (!preco) {
            alert("Selecione uma aula válida.");
            return;
        }

        if (isNaN(qtdVal) || qtdVal < 1) {
            alert("Quantidade mínima é 1.");
            return;
        }

        if (!confirm("Confirmar reserva?")) return;

        atualizarTotal();

        const formData = new FormData(form);
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "../php/registrar_aula.php", true);

        xhr.onload = function () {
            const resp = xhr.responseText.trim();
            if (resp.includes("OK")) {
                alert("Reserva realizada com sucesso!");
                window.location.href = "index.php";
            } else {
                alert("Erro: " + resp);
            }
        };

        xhr.onerror = function () {
            alert("Erro ao conectar com o servidor.");
        };

        xhr.send(formData);
    });

});
