<?php
    //Importa imagensFilmes
    require_once(__DIR__ . "\\..\\modelo\\imagensFilme.php");

    /*
    classe que faz a conexão com a tabela imagens_filme do banco de dados:
    adicionando, buscando, alterando, deletando, entre outras funções
    */ 
    class ImagensRepositorio{ 

        //atributo pdo se refere a coneção dele com o banco de dados
        private $pdo;

        public function __construct(PDO $pdo) {
            $this->pdo = $pdo;
        }

        // pega as referencias das imagens no banco de dados e transforma em um objeto ImagensFilme
        private function formarObjeto($dados)
        {
            return new ImagensFilme($dados['id_filme'],
                $dados['capa'],
                $dados['logo'],
                $dados['trailer'],
                $dados['fundo']);
        }

        //busca as referencias das imagens no banco de dados referete ao seu id_filme
        public function buscarPorId(int $id): ImagensFilme  {
            $sql = "SELECT * FROM imagens_filme WHERE id_filme = ?";
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(1,$id);
            $statement->execute();
    
            $dados = $statement->fetch(PDO::FETCH_ASSOC);
    
            return $this->formarObjeto($dados);
        }

        //deleta as referencias das imagens do banco de dados referente ao seu id_filme
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
        
    
        //salva as referencias das imagens recebidas no banco de dados
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

        //atualisa as referencias das imagens no banco de dados
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