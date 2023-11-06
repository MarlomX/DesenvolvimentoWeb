<?php
    require_once ("src\\conexaoBD.php");
    require_once ("src\\modelo\\filme.php");
    require_once ("src\\modelo\\imagensFilme.php");
    require_once ("src\\repositorio\\filmeRepositorio.php");

    function defineImagem($aDefinir):string{
        if (isset($_FILES[$aDefinir])) {
            $nomeOriginal = $_FILES[$aDefinir]['name'];
            $tmpNome = $_FILES[$aDefinir]['tmp_name'];

            // Gere um nome único para cada imagemque não passe de 50 caracteres
            $extensao = pathinfo($nomeOriginal, PATHINFO_EXTENSION); // Obtém a extensão do arquivo
            $parteFinalNome = substr($nomeOriginal, -10); // Obtém os últimos 10 caracteres do nome original
            $uniqidPart = substr(uniqid(), 0, 6); // gera um nome unico que não passe de 40 caracteres
            $nomeUnico = $uniqidPart . '_' . $parteFinalNome . '.' . $extensao;
          
            
            $nomeUnico = uniqid() . $nomeOriginal;
    
            // Defina o diretório de destino para salvar cada imagem
            $diretorioDestino = 'imagens\imagens-filmes\\' . $nomeUnico;
    
            // Mova a imagem para o diretório de destino
            move_uploaded_file($tmpNome, $diretorioDestino);
    
            return $nomeUnico;
        }
        return "padrao";
    }
    
      $repositorio = new FilmeRepositorio($pdo);
      
    if (isset($_POST['cadastro'])){
        $imagens = new ImagensFilme(null);

        // Verifique se o usuário fez upload de uma imagem
        $capa = defineImagem('capa');
        if ($capa !== "padrao") {
            $imagens->setCapa($capa);
        }

        $logo = defineImagem('logo');
        if ($logo !== "padrao") {
            $imagens->setLogo($logo);
        }
        
        $trailer = defineImagem('trailer');
        if ($trailer !== "padrao") {
            $imagens->setTrailer($trailer);
        }

        $fundo = defineImagem('fundo');
        if ($fundo !== "padrao") {
            $imagens->setFundo($fundo);
        }

        $elenco = explode(";", $_POST['elenco']); 

        $filme = new Filme(null,
            $_POST['titulo'],
            $_POST['comentario'],
            $_POST['sinopse'],
            $_POST['clasificacao'],
            $elenco,
            $imagens);

        $repositorio = new FilmeRepositorio($pdo);
        $repositorio->salvar($filme);

        header("Location:menu.php");
    };
?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/form.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="img/icone-serenatto.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>Serenatto - Cadastrar Produto</title>
</head>
<body>
<main>
    <section class="container-admin-banner">
        <img src="img/logo-serenatto-horizontal.png" class="logo-admin" alt="logo-serenatto">
        <h1>Cadastro de Produtos</h1>
        <img class= "ornaments" src="img/ornaments-coffee.png" alt="ornaments">
    </section>
    <section class="container-form">
        <form method="post" enctype="multipart/form-data">

            <label for="titulo">Titulo</label>
            <input type="text" id="titulo" name="titulo" placeholder="Digite o titulo do filme" required>

            <label for="sinopse">Sinopse</label>
            <input type="text" id="sinopse" name="sinopse" placeholder="Digite a sinopse do filme Max 500 Caracteres" required>
            
            <label for="comentario">Comentario</label>
            <input type="text" id="comentario" name="comentario" placeholder="Digite um comentario sobre o filme" required>

            <label for="clasificacao">Clasificacao Indicativa</label>
            <input type="text" id="clasificacao" name="clasificacao" placeholder="Digite a clasificacao do filme" required>

            <label for="elenco">Elenco</label>
            <input type="text" id="elenco" name="elenco" placeholder="Digite o elenco do filme separando por ;" required>

            <label for="imagem">Envie a Capa do filme</label>
            <input type="file" name="capa" accept="image/*" id="capa" placeholder="Envie a capa">

            <label for="imagem">Envie o logo do filme</label>
            <input type="file" name="logo" accept="image/*" id="logo" placeholder="Envie o logo">

            <label for="imagem">Envie o trailer do filme</label>
            <input type="file" name="trailer" accept="video/* id="trailer" placeholder="Envie o tralier">

            <label for="imagem">Envie o fundo do filme</label>
            <input type="file" name="fundo" accept="image/*" id="fundo" placeholder="Envie o fundo">

            <input type="submit" name="cadastro" class="botao-cadastrar" value="Cadastrar produto"/>
        </form>
    
    </section>
</main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js" integrity="sha512-Rdk63VC+1UYzGSgd3u2iadi0joUrcwX0IWp2rTh6KXFoAmgOjRS99Vynz1lJPT8dLjvo6JZOqpAHJyfCEZ5KoA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>