<?php
    require_once ("src\\conexaoBD.php");
    require_once ("src\\repositorio\\filmeRepositorio.php");
    require_once ("src\\repositorio\\imagensRepositorio.php");
    require_once("src\\modelo\\imagensFilme.php");

    $repositorioImagens = new ImagensRepositorio($pdo);
    $imagens = $repositorioImagens->buscarPorId($_POST['id']);
    $repositorioImagens->deletarImagensDiretorio($imagens);

    $repositorio = new FilmeRepositorio($pdo);
    $repositorio->deletar($_POST['id']);
    header('Location: menu.php?mensagem=Filme+deletado+com+sucesso');
    exit;
?>
