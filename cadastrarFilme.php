<?php
    //Importa conexaoBD, filme, imegensFilme e filmeRepositorio
    require_once ("src\\conexaoBD.php");
    require_once ("src\\modelo\\filme.php");
    require_once ("src\\modelo\\imagensFilme.php");
    require_once ("src\\repositorio\\filmeRepositorio.php");

    /*
    função que se o usuario tiver enviado arquivos e devolve esse arquivo com um nome unico
    e formatadoalem de enviar esse arquivo para o diretorio de imagens.
    */
    function defineImagem($aDefinir):string{
        // $aDesfinir refere a qual tipo de arquivo sera verificada, capa, trailer, fundo ...

        //verifica se o usuario enviou o arquivo.
        if (!empty($_FILES[$aDefinir]['name'])) {
            $nomeOriginal = $_FILES[$aDefinir]['name'];
            $tmpNome = $_FILES[$aDefinir]['tmp_name'];

            // Gere um nome único para cada arquivo que não passe de 50 caracteres
            $extensao = pathinfo($nomeOriginal, PATHINFO_EXTENSION); // Obtém a extensão do arquivo
            $parteFinalNome = substr($nomeOriginal, -10); // Obtém os últimos 10 caracteres do nome original
            $uniqidPart = substr(uniqid(), 0, 30); // gera um nome unico que não passe de 30 caracteres
            $nomeUnico = $uniqidPart . '_' . $parteFinalNome . '.' . $extensao; //junta tudo em uma variavel
    
            // Defina o diretório de destino para salvar cada arquivo
            $diretorioDestino = 'imagens\imagens-filmes\\' . $nomeUnico;
    
            // Move a arquivo para o diretório de destino
            move_uploaded_file($tmpNome, $diretorioDestino);
    
            return $nomeUnico; //retorna o nome do novo arquivo
        }
        return "padrao"; //retorna padrão o que faz as imagens serem as imagens padroes
    }
    
    $repositorio = new FilmeRepositorio($pdo);

    //verifica se o usuario enviou o formulario  
    if (isset($_POST['cadastro'])){
        $imagens = new ImagensFilme(null);

        // Verifique se o usuário fez upload dos arquivos
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

        //separa o texto do elenco por ; e transforma em um array
        $elenco = explode(";", $_POST['elenco']); 

        //junta todas as informações em um objeto filme
        $filme = new Filme(null,
            $_POST['titulo'],
            $_POST['comentario'],
            $_POST['sinopse'],
            $_POST['clasificacao'],
            $elenco,
            $imagens);

        $repositorio = new FilmeRepositorio($pdo);
        $repositorio->salvar($filme); //salva o filme no banco de dados

        header("Location:menu.php"); // redireciona para a pagina do menu
    };
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styleFormulario.css">
    <title>Purple Filmes Cadastra</title>
    <header>
        <nav class="navbar">
            <div class="titulo">
                <p>Purple Filmes</p>
            </div>

            <div class="logo">
                <img src="imagens/Logo.png" alt="Filmes">
            </div>
            <div class="menu">

                <ul>
                    <li><a href="index.php">Filmes</a></li>
                    <li><a href="src/autenticarSessao.php">Menu</a></li>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="src/logout.php">Logout</a></li>
                </ul>

            </div>
        </nav>
    </header>
</head>

<body>
    <main>
        <section class="container-admin-banner">
            <h1>Cadastrar Filmes</h1>
            <img class="ornaments" src="imagens/Logo.png" alt="ornaments">
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
                <input type="file" name="capa" accept="image/*" id="imagem" placeholder="Envie a capa">

                <label for="imagem">Envie o logo do filme</label>
                <input type="file" name="logo" accept="image/*" id="imagem" placeholder="Envie o logo">

                <label for="imagem">Envie o trailer do filme</label>
                <input type="file" name="trailer" accept="video/*" id="imagem" placeholder="Envie o tralier">

                <label for="imagem">Envie o fundo do filme</label>
                <input type="file" name="fundo" accept="image/*" id="imagem" placeholder="Envie o fundo">

                <input type="submit" name="cadastro" class="botao-cadastrar" value="Cadastrar filme" />






            </form>

        </section>
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"
        integrity="sha512-Rdk63VC+1UYzGSgd3u2iadi0joUrcwX0IWp2rTh6KXFoAmgOjRS99Vynz1lJPT8dLjvo6JZOqpAHJyfCEZ5KoA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

</html>