<?php
    //Importa conexaoBD e o filmeRepositorio
    require "src\\conexaoBD.php";
    require "src\\repositorio\\filmeRepositorio.php";

    //pega o filme do banco de dados referente ao id
    $repositorio = new FilmeRepositorio($pdo);
    $filme = $repositorio->buscarPorId($_POST['id']);
    
    // muda a nota antiga para a nova e salva no banco de dados.
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nota = $_POST['nota'];
        $filme->setNota($nota);
        $repositorio->atualizar($filme);
      }
      
?>