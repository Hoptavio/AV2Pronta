document.addEventListener("DOMContentLoaded", function () {

    const selectExperiencia = document.getElementById("select_experiencia");
    const idField = document.getElementById("id_experiencia");
    const qtdPessoas = document.getElementById("quantidade");
    const totalInput = document.getElementById("total");
    const form = document.getElementById("formReserva");
    const titulo = document.getElementById("titulo");

    const metodoEl = document.getElementById("metodo_pagamento");
    const areaPix = document.getElementById("area_pix");
    const areaCartao = document.getElementById("area_cartao");
    const parcelasEl = document.getElementById("parcelas");
    const valorParcelaEl = document.getElementById("valor_parcela");

    fetch("../php/listar_experiencias.php")
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
            selectExperiencia.innerHTML = html;

            const params = new URLSearchParams(window.location.search);
            const id = params.get('id');
            if (id) {
                selectExperiencia.value = id;
                const event = new Event('change');
                selectExperiencia.dispatchEvent(event);
            }
        })
        .catch(error => {
            console.error("Erro ao carregar experiências:", error);
            selectExperiencia.innerHTML = `<option value="">Erro ao carregar opções</option>`;
            alert("Erro ao carregar as experiências. Por favor, recarregue a página.");
        });

    selectExperiencia.addEventListener("change", function () {
        const op = this.selectedOptions[0];

        if (!op.value) {
            idField.value = "";
            titulo.textContent = "Finalizar Reserva de Experiência";
            totalInput.value = "";
            return;
        }

        idField.value = op.value;
        const nome = op.getAttribute("data-nome");
        titulo.textContent = "Reservar: " + nome;
        atualizarTotal();
    });

    function getPrecoSelecionado() {
        const opcao = selectExperiencia.selectedOptions[0];
        const preco = opcao ? parseFloat(opcao.getAttribute("data-preco")) : 0;
        return isNaN(preco) ? 0 : preco;
    }

    function atualizarTotal() {
        const preco = getPrecoSelecionado();
        const pessoas = parseInt(qtdPessoas.value, 10);

        if (!preco || isNaN(pessoas) || pessoas < 1) {
            totalInput.value = "";
            atualizarParcelas();
            return;
        }

        const total = preco * pessoas;
        totalInput.value = total.toFixed(2);

        atualizarParcelas();
    }

    function atualizarParcelas() {
        const total = parseFloat(totalInput.value.replace(",", "."));
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

    selectExperiencia.addEventListener("change", atualizarTotal);
    qtdPessoas.addEventListener("input", atualizarTotal);



    atualizarTotal();

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const preco = getPrecoSelecionado();
        const pessoasVal = parseInt(qtdPessoas.value, 10);

        if (!preco) {
            alert("Selecione uma experiência válida.");
            return;
        }

        if (isNaN(pessoasVal) || pessoasVal < 1) {
            alert("Quantidade mínima é 1 pessoa.");
            return;
        }

        if (!confirm("Confirmar reserva?")) return;

        atualizarTotal();

        const formData = new FormData(form);
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "../php/registrar_experiencia.php", true);

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
