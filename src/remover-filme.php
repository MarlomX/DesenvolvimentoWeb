<?php
    require_once ("conexaoBD.php");
    require_once ("repositorio\\filmeRepositorio.php");

    $repositorio = new FilmeRepositorio($pdo);
    $repositorio->deletar($_POST['id']);
    header('Location: ..\\index.php?mensagem=Filme+deletado+com+sucesso');
    exit;
?>
