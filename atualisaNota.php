<?php
    require "src\\conexaoBD.php";
    require "src\\repositorio\\filmeRepositorio.php";
    
    $repositorio = new FilmeRepositorio($pdo);
    $filme = $repositorio->buscarPorId($_POST['id']);
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nota = $_POST['nota'];
        $filme->setNota($nota);
        $repositorio->atualizar($filme);
      }
      
?>