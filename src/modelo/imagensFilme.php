<?php
    class ImagensFilme{
        private ?int $id;
        private string $capa;
        private string $logo;
        private string $fundo;
        private string $trailer;
        public function __construct(?int $id, string $capa = 'capaPadrao', string $logo = 'logoPadrao', string $trailer = 'semTrailer', string $fundo = 'fundoPadrao' ) {
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
            return $this->capa;
        }
        public function setCapa(string $capa){
            $this->capa = $capa;
        }
        public function getCapaDiretorio(): string{
            $texto = $this->getDiretorio().$this->capa;
            return $texto;
        }


        public function getLogo(): string{
            return $this->logo;
        }
        public function setLogo(string $logo){
            $this->logo = $logo;
        }
        public function getLogoDiretorio(): string{
            return $this->getDiretorio().$this->logo;
        }

        public function getFundo(): string{
            return $this->fundo;
        }
        public function setFundo(string $fundo){
            $this->fundo = $fundo;
        }
        public function getFundoDiretorio(): string{
            return 'imagens/imagens-filmes/'.$this->fundo;
        }

        public function getTrailer(): string{
            return $this->trailer;
        }
        public function setTrailer(string $trailer){
            $this->trailer = $trailer;
        }
        public function getTrailerDiretorio(): string{
            return $this->getDiretorio().$this->trailer;
        }

        public function getImagemClasificacao(string $clasificacao): string{
            return $this->getDiretorio()."clasificacao\\".$clasificacao.".png";
        }

    }
?>