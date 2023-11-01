<?php
    class ImagensFilme{
        private int $id;
        private string $capa;
        private string $logo;
        private string $fundo;
        private string $trailer;
        public function __construct(int $id, string $capa, string $logo, string $trailer, string $fundo) {
            $this->id = $id;
            $this->capa = $capa;
            $this->logo = $logo;
            $this->fundo = $fundo;
            $this->trailer = $trailer;
        }

        public function getId(): int{
            return $this->id;
        }

        private function getDiretorio(): string{
            return "imagens\imagens-filmes\\";
        }
        public function getCapa(): string{
            $texto = $this->getDiretorio()."capa\\".$this->capa.".jpg";
            return $texto;
        }

        public function getLogo(): string{
            return $this->getDiretorio()."logo\\".$this->logo.".png";
        }

        public function getFundo(): string{
            return "imagens/imagens-filmes/fundo/".$this->fundo.".jpg";
        }
        public function getTrailer(): string{
            return $this->getDiretorio()."trailer\\".$this->trailer.".mp4";
        }

        public function getImagemClasificacao(string $clasificacao): string{
            return $this->getDiretorio()."clasificacao\\".$clasificacao.".png";
        }

    }
?>