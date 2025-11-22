<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes da Acomodação - Alugel Maneiro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .detail-img {
            width: 100%;
            max-height: 500px;
            object-fit: cover;
            border-radius: 8px;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold text-dark" href="index.html">Alugel Maneiro</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="vagas.html">Acomodações</a></li>
                    <li class="nav-item"><a class="nav-link" href="experiencias.html">Experiências</a></li>
                    <li class="nav-item"><a class="nav-link" href="servicos.html">Serviços</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.html">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container flex-grow-1">
        <div class="row">
            <div class="col-md-8">
                <img id="detail-img" src="" alt="Acomodação" class="detail-img mb-3">
            </div>
            <div class="col-md-4">
                <h2 id="detail-title" class="mb-3"></h2>
                <p id="detail-desc" class="lead"></p>
                <h3 class="text-primary mb-4" id="detail-price"></h3>

                <a id="btn-alugar" href="#" class="btn btn-success btn-lg w-100">Alugar Agora</a>
                <a href="vagas.html" class="btn btn-outline-secondary w-100 mt-2">Voltar</a>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-light mt-5 py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>Alugel Maneiro</h5>
                    <p>Encontre a acomodação perfeita para você!</p>
                </div>
                <div class="col-md-6 text-end">
                    <p>&copy; <span id="current-year"></span> Alugel Maneiro. Todos os direitos reservados.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('current-year').textContent = new Date().getFullYear();

        
        const params = new URLSearchParams(window.location.search);
        const id = params.get('id');
        const title = params.get('title');
        const desc = params.get('desc');
        const price = params.get('price');
        const img = params.get('img');
        const target = params.get('target') || 'alugar.html'; // 

        if (title) document.getElementById('detail-title').textContent = title;
        if (desc) document.getElementById('detail-desc').textContent = desc;
        if (price) document.getElementById('detail-price').textContent = price;
        if (img) document.getElementById('detail-img').src = img;

        if (id) {
            document.getElementById('btn-alugar').href = `${target}?id=${id}`;
           
            if (target.includes('experiencia')) {
                document.getElementById('btn-alugar').textContent = "Reservar Experiência";
            } else if (target.includes('aula')) {
                document.getElementById('btn-alugar').textContent = "Agendar Aula/Serviço";
            }
        } else {
            document.getElementById('btn-alugar').style.display = 'none';
        }
    </script>

</body>

</html>