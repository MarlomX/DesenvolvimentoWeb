<?php
    require "src/conexao-bd.php";
    require "src/repositorio/filmeRepositorio.php";

    $repositorio = new FilmeRepositorio($pdo);
    $repositorio->deletar($_POST['id']);
    header('Location: index.php?mensagem=Filme+deletado+com+sucesso');
    exit;
?>
