<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/carrossel.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/carrossel.js" defer></script>
    <title>Alugo & Rio - Experiências</title>
</head>

<body class="d-flex flex-column min-vh-100">

    <?php include 'navbar.php'; ?>

    <div class="main-carousel">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0"
                    class="active"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://i.pinimg.com/736x/ef/b5/e1/efb5e1eb66bf41dc03e4ffd37f6059db.jpg"
                        class="d-block w-100" alt="Cristo Redentor" style="height: 500px; object-fit: cover;">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Visite os melhores pontos turisticos do Rio de Janeiro</h3>
                        <p>Descubra passeios incríveis e momentos únicos em destinos paradisíacos.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://i.pinimg.com/736x/82/13/92/821392f814e3a830f3a31f2220242bf2.jpg"
                        class="d-block w-100" alt="Passeio de barco" style="height: 500px; object-fit: cover;">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Aventuras Inesquecíveis</h3>
                        <p>Passeios de barco, trilhas ecológicas e muito mais.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://i.pinimg.com/1200x/cc/53/06/cc5306727725943c503082319409850a.jpg"
                        class="d-block w-100" alt="Cabana na floresta" style="height: 500px; object-fit: cover;">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Conforto e Beleza</h3>
                        <p>Hospede-se nos locais mais incríveis do mundo.</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </div>

    <div class="container flex-grow-1">
        <h1 class="page-header">Viva Experiências Únicas</h1>
        <p class="page-subtitle">Descubra passeios, excursões e atividades incríveis para tornar sua viagem inesquecível
        </p>


        <div class="card-container">
            <div class="card">
                <img src="https://images.unsplash.com/photo-1506929562872-bb421503ef21" class="card-img-top"
                    alt="Passeio de barco">
                <div class="card-body">
                    <h5 class="card-title">Passeio de Barco </h5>
                    <p class="card-text">Navegue pelas águas cristalinas e descubra paraísos tropicais escondidos.</p>
                    <p class="price">R$ 150,00 / pessoa</p>
                    <a href="detalhes.html?id=1&title=Passeio%20de%20Barco&desc=Navegue%20pelas%20águas%20cristalinas%20e%20descubra%20paraísos%20tropicais%20escondidos.&price=R$%20150,00%20/%20pessoa&img=https://images.unsplash.com/photo-1506929562872-bb421503ef21&target=experiencia_pagar.php"
                        class="btn btn-primary">Ver Detalhes</a>
                </div>
            </div>

            <div class="card">
                <img src="https://images.unsplash.com/photo-1551632811-561732d1e306" class="card-img-top"
                    alt="Trilha na natureza">
                <div class="card-body">
                    <h5 class="card-title">Trilha Ecológica com Guia</h5>
                    <p class="card-text">Explore a natureza em sua forma mais pura com guias especializados.</p>
                    <p class="price">R$ 80,00 / pessoa</p>
                    <a href="detalhes.html?id=2&title=Trilha%20Ecológica%20com%20Guia&desc=Explore%20a%20natureza%20em%20sua%20forma%20mais%20pura%20com%20guias%20especializados.&price=R$%2080,00%20/%20pessoa&img=https://images.unsplash.com/photo-1551632811-561732d1e306&target=experiencia_pagar.php"
                        class="btn btn-primary">Ver Detalhes</a>
                </div>
            </div>

            <div class="card">
                <img src="https://images.unsplash.com/photo-1564399579883-451a5d44ec08?q=80&w=737&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    class="card-img-top" alt="Museu">
                <div class="card-body">
                    <h5 class="card-title">Tour Pelos Museus </h5>
                    <p class="card-text">Conheça a história e cultura local com visitas ao maiores museus do Rio .</p>
                    <p class="price">R$ 120,00 / pessoa</p>
                    <a href="detalhes.html?id=3&title=Tour%20Pelos%20Museus&desc=Conheça%20a%20história%20e%20cultura%20local%20com%20visitas%20ao%20maiores%20museus%20do%20Rio.&price=R$%20120,00%20/%20pessoa&img=https://images.unsplash.com/photo-1564399579883-451a5d44ec08?q=80&w=737&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&target=experiencia_pagar.php"
                        class="btn btn-primary">Ver Detalhes</a>
                </div>
            </div>
        </div>




        <h2 class="section-title">Experiências perto de você</h2>


        <div class="banner">
            <button class="arrow-left control" aria-label="Previous image">◀</button>
            <button class="arrow-right control" aria-label="Next Image">▶</button>

            <div class="bannerBox">
                <div class="banners">
                    <img src="https://images.unsplash.com/photo-1564399579883-451a5d44ec08?q=80&w=737&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        alt="Museu" class="atual item">
                    <img src="https://images.unsplash.com/photo-1469474968028-56623f02e42e" alt="Montanha" class="item">
                    <img src="https://plus.unsplash.com/premium_photo-1711631731018-69796fae742a?q=80&w=415&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        alt="Campo de flores" class="item">
                    <img src="https://images.unsplash.com/photo-1439066615861-d1af74d74000" alt="" class="Pier">
                    <img src="https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1" alt="Barco" class="item">
                </div>
            </div>
        </div>

    </div>

    <?php include 'footer.php'; ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('current-year').textContent = new Date().getFullYear();
    </script>
</body>

</html>