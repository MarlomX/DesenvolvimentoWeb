<?php
  require_once ("src/conexaoBD.php");
  require_once ("src/repositorio/usuarioRepositorio.php");
  
  $repositorio = new UsuarioRepositorio($pdo);
  
  if (isset($_POST['entrar'])){
    if($repositorio->autenticar($_POST['nickname'],$_POST['senha'])){
      header('Location: index.php?mensagem=Usuario+logado+com+sucesso');
      exit; 
    }
    header('Location: login.php?mensagem=Senha+e+ou+Usuario+incorreto');
    exit; 
  }
?>
<script>
    // Verifica se há uma mensagem na URL
    const urlParams = new URLSearchParams(window.location.search);
    const mensagem = urlParams.get('mensagem');

    // Se houver uma mensagem, exibe-a usando um alert
    if (mensagem) {
        alert(mensagem);
    }
</script>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="css/styleLogin.css">
  <script src="https://kit.fontawesome.com/cf6fa412bd.js" crossorigin="anonymous"></script>
</head>
<body>
  <div class="container">
    <div class="buttonsForm">
      <div class="btnColor"></div>
      <button id="btnSignin">Entrar</button>
    </div>

    <form id="signin" method="post">
      <input type="text" name="nickname" placeholder="Usuário" required />
      <i class="fas fa-envelope iUsuario01"></i>
      <input type="password" name="senha" placeholder="Senha" required />
      <i class="fas fa-lock iPassword01"></i>
      <button type="Entrar" name="entrar" >Entrar</button>
      <button type="submit" id="btnVoltar" onclick="voltarParaPaginaInicial()">Voltar a página inicial</button>
    
    </form>
  </div>

  <script src="index.js"></script>
  <script>
    function voltarParaPaginaInicial() {
      window.location.href = "index.php";
    }
  </script>
</body>
</html>