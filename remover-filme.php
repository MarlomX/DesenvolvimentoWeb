<?php
    //Importa conexaoBD, filmeRepositorio, imagensRepositorio e imagensFilme
    require_once ("src\\conexaoBD.php");
    require_once ("src\\repositorio\\filmeRepositorio.php");
    require_once ("src\\repositorio\\imagensRepositorio.php");
    require_once("src\\modelo\\imagensFilme.php");

    /*
    Pega a referencia das imagens do filme que sera deletado do banco de dado.
    E deleta as imgens referente a esse filme do diretorio
    */
    $repositorioImagens = new ImagensRepositorio($pdo);
    $imagens = $repositorioImagens->buscarPorId($_POST['id']);
    $repositorioImagens->deletarImagensDiretorio($imagens);

    /*
    Pega referencia do filme que sera deletado, é o deleta do banco de dados.
    Depois redireciona para a pagina de menu, e depois garante que o code para de se executado.
    */
    $repositorio = new FilmeRepositorio($pdo);
    $repositorio->deletar($_POST['id']);
    header('Location: menu.php?mensagem=Filme+deletado+com+sucesso');
    exit;
?>
