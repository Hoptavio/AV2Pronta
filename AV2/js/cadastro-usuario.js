document.getElementById("formCadastro").addEventListener("submit", function (e) {
    e.preventDefault();

    const dados = new FormData(this);

    fetch("../php/cadastro-usuario.php", {
        method: "POST",
        body: dados
    })
        .then(response => response.text())
        .then(resposta => {
            const div = document.getElementById("resultado");

            if (resposta === "OK") {
                div.innerHTML = "<span class='text-success'>Cadastro realizado! Redirecionando...</span>";
                setTimeout(() => window.location.href = "login.html", 2000);
            } else {
                div.innerHTML = "<span class='text-danger'>" + resposta + "</span>";
            }
        });
});
