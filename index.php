<?php
    require "src\\conexaoBD.php";
    require "src\\repositorio\\filmeRepositorio.php";

    session_start();
    
    $repositorio = new FilmeRepositorio($pdo);
    $filmes = $repositorio->buscaTodos();
    
?>

<script>
    // Verifica se há uma mensagem na URL
    const urlParams = new URLSearchParams(window.location.search);
    const mensagem = urlParams.get('mensagem');

    // Se houver uma mensagem, exibe-a usando um alert
    if (mensagem) {
        alert(mensagem);
    }
</script>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Filmes</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="shortcut icon" href="imagens/Logo.png" type="image/x-icon">
    <header>
        <title>FILMES</title>
        <nav class="navbar">
            <div class="titulo">
                <p>Purple Filmes</p>
            </div>

            <div class="logo">
                <img src="imagens/Logo.png" alt="Filmes">
            </div>
            <div class="menu">

                <ul>
                    <li><a href="index.php">Filmes</a></li>
                    <li><a href="src/autenticarSessao.php">Menu</a></li>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="src/logout.php">Logout</a></li>
                </ul>
            </div>
            <div class="search-box">
                <input type="text" class="search-txt" placeholder="Pesquisar">
                <a href="#" class="search-btn">
                    <img src="imagens/loupe.png" alt="Lupa" height="20" width="20">
                </a>
        </nav>
    </header>
    <script>
        // Função para filtrar os cards com base no texto digitado na pesquisa
        function filtrarCards() {
            var termoPesquisa = document.querySelector(".search-txt").value.toLowerCase(); // Obtém o texto da pesquisa em letras minúsculas
            var cards = document.querySelectorAll(".filme-card"); // Seleciona todos os elementos com a classe "filme-card"

            cards.forEach(function(card) {
                var titulo = card.querySelector("h1").textContent.toLowerCase(); // Obtém o título do card em letras minúsculas

                // Verifica se o título do card contém o termo de pesquisa
                if (titulo.includes(termoPesquisa)) {
                    card.style.display = "block"; // Mostra o card
                } else {
                    card.style.display = "none"; // Oculta o card
                }
            });
        }
        // Adiciona um ouvinte de eventos ao campo de pesquisa para chamar a função de filtragem
        document.querySelector(".search-txt").addEventListener("input", filtrarCards);
    </script>
</head>

<body>
    <div class="cards">
    <?php foreach ($filmes as $filme):?>
        <div class="card filme-card">
            <img src="<?=$filme->getImagens()->getCapaDiretorio()?>">
            <div class="info">
                <h1><?=$filme->getTitulo() ?></h1>
                <p><?=$filme->getComentario() ?></p>
                <a href="card.php?id=<?= $filme->getId() ?>" class="btn">Mais</a>
            </div>
        </div>
    <?php endforeach; ?>

    </div>
</body>

</html>
