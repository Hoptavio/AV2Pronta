<?php
require "conexao.php";

$experiencias = [
    [
        'nome' => 'Passeio de Barco',
        'descricao' => 'Navegue pelas águas cristalinas e descubra paraísos tropicais escondidos.',
        'preco' => 150.00,
        'imagem' => 'img/barco.jpg'
    ],
    [
        'nome' => 'Trilha Ecológica com Guia',
        'descricao' => 'Explore a natureza em sua forma mais pura com guias especializados.',
        'preco' => 80.00,
        'imagem' => 'img/trilha.jpg'
    ],
    [
        'nome' => 'Tour Pelos Museus',
        'descricao' => 'Conheça a história e cultura local com visitas ao maiores museus do Rio .',
        'preco' => 120.00,
        'imagem' => 'img/tour.jpg'
    ]
];

foreach ($experiencias as $exp) {
    $nome = $exp['nome'];
    $descricao = $exp['descricao'];
    $preco = $exp['preco'];
    $imagem = $exp['imagem'];

    $sql = "INSERT INTO experiencias (nome, descricao, preco, imagem) VALUES ('$nome', '$descricao', $preco, '$imagem')";

    if ($con->query($sql) === TRUE) {
        echo "Inserido: $nome\n";
    } else {
        echo "Erro ao inserir $nome: " . $con->error . "\n";
    }
}
