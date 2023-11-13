<?php
  //Importa conexaoBD e o usuarioRepositorio
  require_once ("src/conexaoBD.php");
  require_once ("src/repositorio/usuarioRepositorio.php");
  
  //  pega referencia com o banco de dado dos usuarios
  $repositorio = new UsuarioRepositorio($pdo);
  
  // verifica se apertou o botão de entrar
  if (isset($_POST['entrar'])){
    //verifica se o usuario e senhaa estão corretos
    if($repositorio->autenticar($_POST['nickname'],$_POST['senha'])){
      //manda para a pagina inicial com uma mensagem confirma que o login occoreu com sucesso
      header('Location: index.php?mensagem=Usuario+logado+com+sucesso');
      exit; 
    }
    //manda o usuario para essa mesma pagina com uma menssagem avisando que o login não funcionou.
    header('Location: login.php?mensagem=Senha+e+ou+Usuario+incorreto');
    exit; 
  }
?>
<!-- Scirpt que verifica se há uma mensagem no URL é a exibe -->
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
  <!-- Scirpt que caso o botão de voltar for apertado volta para pagina inicial -->
  <script>
    function voltarParaPaginaInicial() {
      window.location.href = "index.php";
    }
  </script>
</body>
</html>