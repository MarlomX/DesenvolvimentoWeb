<?php
    //Importa conexaoBD e o filmeRepositorio
    require "src\\repositorio\\filmeRepositorio.php";
    require "src\\conexaoBD.php";

    //Busca todas as  referencias de filmes no banco de dados é colocam dentro de um array chamado $filmes
    $repositorio = new FilmeRepositorio($pdo);
    $filmes = $repositorio->buscaTodos();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/styleMenu.css">
    <title>Edit</title>
</head>
<header>
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
<!-- Scirpt que da a funcionalidade da barra de pesquisa -->
<script>
        // Função para filtrar as linhas da tabela com base no texto digitado na pesquisa
        function filtrarTabela() {
            var termoPesquisa = document.querySelector(".search-txt").value.toLowerCase(); // Obtém o texto da pesquisa em letras minúsculas
            var linhas = document.querySelectorAll(".elemento-tabela"); // Seleciona todos os elementos com a classe "elemento-tabela"

            linhas.forEach(function(linha) {
                var titulo = linha.querySelector(".campo-titulo").textContent.toLowerCase(); // Obtém o título do filme em letras minúsculas

                // Verifica se o título do filme contém o termo de pesquisa
                if (titulo.includes(termoPesquisa)) {
                    linha.style.display = "block"; // Mostra o filme
                } else {
                    linha.style.display = "none"; // Oculta a linha
                }
            });
        }
        // Adiciona um ouvinte de eventos ao campo de pesquisa para chamar a função de filtragem
        document.querySelector(".search-txt").addEventListener("input", filtrarTabela);
</script>

<body>
    <div class="table-pai">
    
        <img src="imagens/Logo.png" alt="Logo">
        <table class="table">
            <thead>
                <tr>
                    <th>Titulo</th>
                    <th>Sinopse</th>
                    <th>Faixa etária</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </tr>
            </thead>
            <tbody>
                <!-- O codigo cria uma linha para cada filme dentro da lista, que contem
                valores como o titulo, sinopse, faixa etária e o id do filme -->
                <?php foreach($filmes as $filme): ?>
                    <tr class = "elemento-tabela">
                        <td data-label="Titulo" class="campo-titulo"><?= $filme->getTitulo() ?></td>
                        <td data-label="Sinopse"><?= $filme->getSinopse() ?></td>
                        <td data-label="Faixa etária" ><?= $filme->getClasificacao() ?></td>
                        <td>
                            <!-- Botão que leva para a pagina para editar o filme -->
                            <a href="editarFilme.php?id=<?= $filme->getId()?>" class="botaoEditar" onclick="editarLinha(this)">Editar</a>
                        </td>
                        <td>
                            <!-- Botão que ativa a  funcionalidade de deletar o filme -->
                            <form action="remover-filme.php" method="post">
                                <input type="hidden" name="id" value="<?= $filme->getId() ?>">
                                <input type="submit" class="botaoExcluir" value="Excluir">
                            </form>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>

        <!-- Botão que leva para a pagina para adicionar um  novo filme -->
        <a href="cadastrarFilme.php" class="botaoAdicionar">Adicionar Filme </a>

    </div>
</body>

</html>