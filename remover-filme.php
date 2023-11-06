<?php
    require_once ("src\\conexaoBD.php");
    require_once ("src\\repositorio\\filmeRepositorio.php");

    $repositorio = new FilmeRepositorio($pdo);
    $repositorio->deletar($_POST['id']);
    header('Location: index.php?mensagem=Filme+deletado+com+sucesso');
    exit;
?>
