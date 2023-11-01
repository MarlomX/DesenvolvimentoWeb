<?php
    require_once ("src/conexaoBD.php");
    require_once ("src/repositorio/usuarioRepositorio.php");

    $repositorio = new UsuarioRepositorio($pdo);

    if($repositorio->autenticar($_GET['nickname'],$_GET['senha'])){
        header('Location: index.php?mensagem=Usuario+logado+com+sucesso');
        exit; 
    }
    header('Location: formularioUsuario.php?mensagem=Usuario+não+logado');
    exit; 

?>
