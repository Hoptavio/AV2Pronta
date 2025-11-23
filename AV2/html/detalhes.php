<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes da Acomodação - Alugo & Rio</title>
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

    <?php include 'navbar.php'; ?>

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

    <?php include 'footer.php'; ?>

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