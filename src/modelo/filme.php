<?php
    //Importa imagensFilme
    require_once(__DIR__ . "\\imagensFilme.php");

    /*
    criar uma classe que representa um filme, com os seguites atributos:
    id, titulo, comentario, sinopse, clasificação, nota, elenco e
     imagens(que representa todos os arquivos de imagen e video do filme)
    */
    class Filme{
        private ?int $id;
        private string $titulo;
        private string $comentario;
        private string $sinopse;
        private string $clasificacao;
        private  $elenco = array();
        private int $nota;

        private ImagensFilme $imagens;

        public function __construct(?int $id, string $titulo, string $comentario, string $sinopse, string $clasificacao, $elenco,  ImagensFilme $imagens, int $nota = 3) {
            $this->id = $id;
            $this->titulo = $titulo;
            $this->comentario = $comentario;
            $this->sinopse = $sinopse;
            $this->clasificacao = $clasificacao;
            $this->nota = $nota;
            $this->elenco = $elenco;
            $this->imagens = $imagens;
        }

        //funções do objeto que emsua maioria e para pegao valor de algum dos atributos do filme
        public function getTitulo():string{
            return $this->titulo;
        }

        public function getid():int{
            return $this->id;
        }

        public function getSinopse(): string{
            return $this->sinopse;
        }

        public function getComentario(): string{
            return $this->comentario;
        }

        public function getClasificacao(): string{
            return $this->clasificacao;
        }

        public function getNota():int{
            return $this->nota;
        }

        public function setNota(int $nota){
            $this->nota = $nota;
        } 

        public function getElenco():array{
            return $this->elenco;
        }

        public function getElencoFormulario():String{
            return implode(";", $this->elenco);
        }

        public function getImagens(): ImagensFilme {
            return $this->imagens;
        }
    }
?>