<?php
    require_once(__DIR__ . "\\..\\modelo\\imagensFilme.php");


    class ImagensRepositorio{
        
        private $pdo;
        public function __construct(PDO $pdo) {
            $this->pdo = $pdo;
        }

        private function formarObjeto($dados)
        {
            return new ImagensFilme($dados['id_filme'],
                $dados['capa'],
                $dados['logo'],
                $dados['trailer'],
                $dados['fundo']);
        }

        public function buscarPorId(int $id): ImagensFilme  {
            $sql = "SELECT * FROM imagens_filme WHERE id_filme = ?";
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(1,$id);
            $statement->execute();
    
            $dados = $statement->fetch(PDO::FETCH_ASSOC);
    
            return $this->formarObjeto($dados);
        }

        public function deletar(int $id){
            $sql = "DELETE FROM imagens_filme WHERE id_filme = ?";
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(1,$id);
            $statement->execute();
    
        }

        //Exclui as imagens do diretorio se elas não forem as imagens padrão
        public function deletarImagensDiretorio(imagensFilme $imagensFilme) {
            if ($imagensFilme->getCapa() != 'capaPadrao.png' && file_exists($imagensFilme->getCapaDiretorio())) {
                unlink($imagensFilme->getCapaDiretorio());
            }
        
            if ($imagensFilme->getLogo() != 'logoPadrao.png' && file_exists($imagensFilme->getLogoDiretorio())) {
                    unlink($imagensFilme->getLogoDiretorio());
            }
        
            if ($imagensFilme->getTrailer() != 'semTrailer' && file_exists($imagensFilme->getTrailerDiretorio())) {
                unlink($imagensFilme->getTrailerDiretorio());
            }
        
            if ($imagensFilme->getFundo() != 'fundoPadrao.jpg' && file_exists($imagensFilme->getFundoDiretorio())) {
                unlink($imagensFilme->getFundoDiretorio());
            }
        }
        
    
        public function salvar(ImagensFilme $imagensFilme, int $id)  {
            $sql = "INSERT INTO imagens_filme (id_filme, capa, logo, trailer, fundo) VALUES (?,?,?,?,?)";
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(1, $id);
            $statement->bindValue(2, $imagensFilme->getCapa());
            $statement->bindValue(3, $imagensFilme->getLogo());
            $statement->bindValue(4, $imagensFilme->getTrailer());
            $statement->bindValue(5, $imagensFilme->getFundo());
            $statement->execute();
        }

        public function atualizar(ImagensFilme $imagensFilme) {
            $sql = "UPDATE imagens_filme SET capa = ?, logo = ?, trailer = ?, fundo = ? WHERE id_filme = ?";
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(1, $imagensFilme->getCapa());
            $statement->bindValue(2, $imagensFilme->getLogo());
            $statement->bindValue(3, $imagensFilme->getTrailer());
            $statement->bindValue(4, $imagensFilme->getFundo());
            $statement->bindValue(5, $imagensFilme->getId());
            $statement->execute();
        }

    }
?>