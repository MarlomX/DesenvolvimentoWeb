<?php
    session_start();

    if (!isset($_SESSION['usuario_logado']) || $_SESSION['usuario_logado'] === null) {
        header('Location: index.php?mensagem=Precisa+fazer+login+primeiro');
        exit; 
    }
    header('Location: menu.php');
        exit; 
?>