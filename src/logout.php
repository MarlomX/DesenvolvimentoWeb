<?php
    // inicia uma sessão caso não tenha iniciado anteriormente
    session_start();
    //remover a informação queo usuario está logado.
    unset($_SESSION['usuario_logado']);
    //direciona para a pagina principal
    header('Location: ..\\index.php?mensagem=Log-out+efetuado+com+sucesso');
    exit; 
?>
