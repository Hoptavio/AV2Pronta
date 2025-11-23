<?php
require "conexao.php";

$sql_commands = [
    // Acomodações
    "UPDATE acomodacoes SET nome='Casa com piscina', descricao='Casa exuberante com jardim e piscina.', preco=350.00, imagem='img/chale.jpg' WHERE id=1",
    "UPDATE acomodacoes SET nome='Apartamento no Centro', descricao='Moderno apartamento no coração da cidade, próximo a todas as atrações.', preco=175.00, imagem='img/apto.jpg' WHERE id=2",
    "UPDATE acomodacoes SET nome='Cabana nas Montanhas', descricao='Aconchegante cabana com lareira e vista deslumbrante para as montanhas.', preco=280.00, imagem='img/cabana.jpg' WHERE id=3",
    "UPDATE acomodacoes SET nome='Hotel em frente a praia', descricao='Charmoso hotel com acesso ao mar.', preco=250.00, imagem='img/hotel.jpg' WHERE id=4",
    "UPDATE acomodacoes SET nome='Lofte', descricao='Esse Loft oferece conforto e beleza além de fácil acesso a diversos pontos turisticos', preco=100.00, imagem='img/vila.jpg' WHERE id=5",
    "UPDATE acomodacoes SET nome='Casa contêiner', descricao='Cassa confortavel de auto custo-beneficio.', preco=35.00, imagem='img/estudio.jpg' WHERE id=6",

    // Aulas
    "UPDATE aulas SET nome='Treino com personal profissional', preco=90.00 WHERE id=1",
    "UPDATE aulas SET nome='Aula de Culinária Regional', preco=120.00 WHERE id=2",
    "UPDATE aulas SET nome='Aula de dança', preco=60.00 WHERE id=3",
    "UPDATE aulas SET nome='Aula de Yoga na Natureza', preco=70.00 WHERE id=4",
    "UPDATE aulas SET nome='Rainha da bateria', preco=150.00 WHERE id=5",
    "UPDATE aulas SET nome='Sessão de Fotografia', preco=140.00 WHERE id=6",

    // Experiências
    "UPDATE experiencias SET nome='Passeio de Barco', descricao='Navegue pelas águas cristalinas e descubra paraísos tropicais escondidos.', preco=150.00, imagem='img/barco.jpg' WHERE id=1",
    "UPDATE experiencias SET nome='Trilha Ecológica com Guia', descricao='Explore a natureza em sua forma mais pura com guias especializados.', preco=80.00, imagem='img/trilha.jpg' WHERE id=2",
    "UPDATE experiencias SET nome='Tour Pelos Museus', descricao='Conheça a história e cultura local com visitas ao maiores museus do Rio .', preco=120.00, imagem='img/tour.jpg' WHERE id=3"
];

echo "<h2>Atualizando Banco de Dados...</h2>";

foreach ($sql_commands as $sql) {
    if ($con->query($sql) === TRUE) {
        echo "<p style='color: green;'>Sucesso: " . htmlspecialchars(substr($sql, 0, 50)) . "...</p>";
    } else {
        echo "<p style='color: red;'>Erro: " . $con->error . "</p>";
    }
}

echo "<h3>Concluído! Você pode apagar este arquivo agora.</h3>";
