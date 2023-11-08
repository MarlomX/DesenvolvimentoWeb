<?php
    session_start();
    unset($_SESSION['usuario_logado']);
    header('Location: ..\\index.php?mensagem=Log-out+efetuado+com+sucesso');
    exit; 
?>
