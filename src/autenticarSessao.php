<?php
    // inicia uma sessão caso não tenha iniciado anteriormente
    session_start();

    //verifica se o usuario não está logado
    if (!isset($_SESSION['usuario_logado']) || $_SESSION['usuario_logado'] === null) {
        //direciona para a pagina de login com um aviso da nescessidade de logar
        header('Location: ..\\login.php?mensagem=Precisa+fazer+login+primeiro');
        exit; 
    }
    //direciona para o menu
    header('Location: ..\\menu.php');
        exit; 
        
?>
