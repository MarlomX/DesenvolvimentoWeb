<?php
    //Importa conexaoBD, filme, imegensFilme, filmeRepositorio e imagensRepositorio
    require_once ("src\\conexaoBD.php");
    require_once ("src\\modelo\\filme.php");
    require_once ("src\\modelo\\imagensFilme.php");
    require_once ("src\\repositorio\\filmeRepositorio.php");
    require_once ("src\\repositorio\\imagensRepositorio.php");

    /*
    função que se o usuario tiver enviado novos arquivo e devolve esse arquivo com um nome unico e formatado
    alem de enviar esse arquivo para o diretorio de imagens e excluir os arquivos anteriores.
    */
    function defineImagem($aDefinir,$arquivoAnterior):string{
        // $aDesfinir refere a qual tipo de arquivo sera verificada, capa, trailer, fundo ...
        //$imagemAnterior como o nome sugere e a referencia do arquivo que sera mudada

        //verifica se o usuario enviou o arquivo.
        if (isset($_FILES[$aDefinir]) && $_FILES[$aDefinir]['size'] > 0) {
            $nomeOriginal = $_FILES[$aDefinir]['name'];
            $tmpNome = $_FILES[$aDefinir]['tmp_name'];
      
            // Gere um nome único para cada arquivo que não passe de 50 caracteres para caber no banco de dados
            $extensao = pathinfo($nomeOriginal, PATHINFO_EXTENSION); // Obtém a extensão do arquivo
            $parteFinalNome = substr($nomeOriginal, -10); // Obtém os últimos 10 caracteres do nome original
            $uniqidPart = substr(uniqid(), 0, 30); // gera um nome unico que não passe de 30 caracteres
            $nomeUnico = $uniqidPart . '_' . $parteFinalNome . '.' . $extensao; //junta tudo em uma variavel

            // Defina o diretório de destino para salvar cada arquivo
            $diretorioDestino = 'imagens\\imagens-filmes\\' . $nomeUnico;

            // Move o arquivo para o diretório de destino
            move_uploaded_file($tmpNome, $diretorioDestino);

            // Verifique se existe um arquivo anterior, e se sim a exclue
            if ($arquivoAnterior && file_exists('imagens\\imagens-filmes\\' . $arquivoAnterior)) {
                unlink('imagens\\imagens-filmes\\' . $arquivoAnterior);
            }
            return $nomeUnico; //retorna o nome do novo arquivo
        }
        //devolve o valor mantem que significa que não existe arquivo novo, mantendo o anterior
        return "mantem";
    }

    $repositorio = new FilmeRepositorio($pdo);
    $repositorioImagem = new ImagensRepositorio($pdo);

    //verifica se o usuario enviou o formulario
    if (isset($_POST['editar'])){

        //busca o filme que sera editado
        $imagens = $repositorioImagem->buscarPorId($_POST['id']);

        // Obtenha os arquivos antigos antes de atualizá-los
        $capaAnterior = $imagens->getCapa();
        $logoAnterior = $imagens->getLogo();
        $trailerAnterior = $imagens->getTrailer();
        $fundoAnterior = $imagens->getFundo();

        // Verifique se o usuário fez upload dos arquivos
        $capa = defineImagem('capa',$capaAnterior);
        if ($capa !== "mantem") {
            $imagens->setCapa($capa);
        }
        $logo = defineImagem('logo',$logoAnterior);
        if ($logo !== "mantem") {
            $imagens->setLogo($logo);
        }
        $trailer = defineImagem('trailer', $trailerAnterior);
        if ($trailer !== "mantem") {
            $imagens->setTrailer($trailer);
        }
        $fundo = defineImagem('fundo', $fundoAnterior);
        if ($fundo !== "mantem") {
            $imagens->setFundo($fundo);
        }
        
        //separa o texto do  elenco por ; e transforma em um array
        $elenco = explode(";", $_POST['elenco']); 

        //junta todas as informações em um objeto filme
        $filme = new Filme($_POST['id'],
            $_POST['titulo'],
            $_POST['comentario'],
            $_POST['sinopse'],
            $_POST['clasificacao'],
            $elenco,
            $imagens);

        //faz a atualisação no banco de dados
        $repositorio->atualizar($filme);

        // redireciona para a pagina do menu
        header("Location:menu.php");
    } else {
        //pega o filme que sera editado
        $filme = $repositorio->buscarPorId($_GET['id']);
    }  
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styleFormulario.css">
    <title>Purple Editar Filmes</title>
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
            <h1>Editar Filme</h1>
            <img class="ornaments" src="imagens/Logo.png" alt="ornaments">
        </section>
        <section class="container-form">
            <form method="post" enctype="multipart/form-data">

                <label for="titulo">Titulo</label>
                <input type="text" id="titulo" name="titulo" placeholder="Digite o titulo do filme"
                    value="<?= $filme->getTitulo()?>" required>

                <label for="sinopse">Sinopse</label>
                <input type="text" id="sinopse" name="sinopse" placeholder="Digite a sinopse do filme Max 500 Caracteres"
                    value="<?= $filme->getSinopse()?>" required>

                <label for="comentario">Comentario</label>
                <input type="text" id="comentario" name="comentario" placeholder="Digite um comentario sobre o filme"
                    value="<?= $filme->getComentario()?>" required>

                <label for="clasificacao">Clasificacao Indicativa</label>
                <input type="text" id="clasificacao" name="clasificacao" placeholder="Digite a clasificacao do filme"
                    value="<?= $filme->getClasificacao()?>" required>

                <label for="elenco">Elenco</label>
                <input type="text" id="elenco" name="elenco" placeholder="Digite o elenco do filme separando por ;"
                value="<?= $filme->getElencoFormulario()?>" required>

                <label for="imagem">Envie a Capa do filme</label>
                <input type="file" name="capa" accept="image/*" id="imagem" placeholder="Envie a capa">

                <label for="imagem">Envie o logo do filme</label>
                <input type="file" name="logo" accept="image/*" id="imagem" placeholder="Envie o logo">

                <label for="imagem">Envie o fundo do filme</label>
                <input type="file" name="fundo" accept="image/*" id="imagem" placeholder="Envie o fundo">

                <label for="imagem">Envie o trailer do filme</label>
                <input type="file" name="trailer" accept="video/*" id="imagem" placeholder="Envie o tralier">

                <input type="hidden" name="id" value="<?= $filme->getId()?>">

                <input type="submit" name="editar" class="botao-cadastrar"  value="Editar filme"/>

            </form>

        </section>
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"
        integrity="sha512-Rdk63VC+1UYzGSgd3u2iadi0joUrcwX0IWp2rTh6KXFoAmgOjRS99Vynz1lJPT8dLjvo6JZOqpAHJyfCEZ5KoA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

</html>