<?php
    require "src\\conexaoBD.php";
    require "src\\repositorio\\filmeRepositorio.php";

    $repositorio = new FilmeRepositorio($pdo);
    $filme = $repositorio->buscarPorId($_GET['id']);
      
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$filme->getTitulo()?></title>
    <link rel="stylesheet" type="text/css" href="styleCard.css">
    <link rel="shortcut icon" href=<?=$filme->getImagens()->getLogoDiretorio()?> type="image/x-icon">
    <style>
        body {
            background-image: url('<?=$filme->getImagens()->getFundoDiretorio()?>');
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
    </style>
</head>

<body>
    <header>
        <a href="#"><img src="<?=$filme->getImagens()->getLogoDiretorio()?>"></a>
        <div class="toggle"><img src="imagens\imagensCards\toggle.png"></div>
    </header>
    <div class="banner">
        <div class="content">
            <h2><span> <?=$filme->getTitulo()?> </span></h2>
            <p><?=$filme->getSinopse()?></p>
            <a href="#" class="play" onclick="toggle();"><img src="imagens\imagensCards\play.png">Trailer</a>
            <div class="slide"></div>
            <ul class="sci">
                <li><a href="index.php"><img
                            src="imagens\imagensCards\voltar.jpg"></a></li>
            </ul>
        </div>

        <div class="estrelas">
            <ul class="avaliacao">
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <?php if($i == $filme->getNota()):?>
                        <li class="star-icon ativo" data-avaliacao="<?= $i ?>"></li>
                    <?php else:?>
                        <li class="star-icon" data-avaliacao="<?= $i ?>"></li>
                    <?php endif; ?>
                <?php endfor; ?>
            </ul>
        </div>
        <div class="classificacao"><img src="<?=$filme->getImagens()->getImagemClasificacao($filme->getClasificacao())?>"></div>
        <div class="elenco">
            <h1>elenco</h1>


            <ol type="1">

                <?php foreach ($filme->getElenco() as $elenco):?>
                <li><?=$elenco?></li>
                <?php endforeach; ?>



            </ol>
        </div>
    </div>

    <div class="trailer">
        <video src="<?=$filme->getImagens()->getTrailerDiretorio()?>" controls="true"></video>
        <img src="imagens\imagensCards\close.png" class="close" onclick="toggle();">
    </div>
    <script type="text/javascript">
        function toggle() {
            var trailer = document.querySelector('.trailer');
            var video = document.querySelector('video');
            trailer.classList.toggle('active');
            video.currentTime = 0;
            video.pause();

        }
    </script>
    <script>
        var stars = document.querySelectorAll('.star-icon');
        document.addEventListener('click', function (e) {
            var classStar = e.target.classList;
            if (!classStar.contains('ativo')) {
                stars.forEach(function (star) {
                    star.classList.remove('ativo');
                });
                classStar.add('ativo');
                var nota = e.target.getAttribute('data-avaliacao');

                // Crie um objeto FormData e adicione a variável 'nota' e 'id' a ele
                var formData = new FormData();
                formData.append('nota', nota);
                formData.append('id', <?= json_encode($filme->getId()) ?>);

                // Faça uma requisição AJAX para enviar os dados para o PHP
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'atualisaNota.php', true);
                xhr.onreadystatechange = function() {
                };
                xhr.send(formData);

            }
        });
    </script>

</body>

</html>
