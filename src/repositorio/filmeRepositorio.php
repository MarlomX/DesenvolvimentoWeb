<?php 
    require_once(__DIR__ . "\\..\\modelo\\filme.php");
    require_once(__DIR__ . "\\imagensRepositorio.php");
    require_once(__DIR__ . "\\elencoRepositorio.php");

    class FilmeRepositorio{

        private $pdo;
        public function __construct(PDO $pdo) {
            $this->pdo = $pdo;
        }
        private function formarObjeto($dados)
        {
            $imagensRepositorio = new ImagensRepositorio($this->pdo);
            $imagens = $imagensRepositorio->buscarPorId($dados["id"]);
            $elencoRepositorio = new ElencoRepositorio($this->pdo);
            $elenco = $elencoRepositorio->buscaElenco($dados["id"]);
            return new Filme($dados['id'],
                $dados['titulo'],
                $dados['comentario'],
                $dados['sinopse'],
                $dados['clasificacao'],
                $elenco,
                $imagens,
                $dados['nota']);
        }

        public function buscaTodos(): array
        {
            $sql = "SELECT * FROM filmes ORDER BY id";
        
            $statement = $this->pdo->query($sql);
            $filmes = $statement->fetchAll(PDO::FETCH_ASSOC);

            $dadosFilmes = array_map(function ($filme){
                return $this->formarObjeto($filme);
            },$filmes);

            return  $dadosFilmes;
        }

        public function buscarPorId(int $id): Filme  {
            $sql = "SELECT * FROM filmes WHERE id = ?";
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(1,$id);
            $statement->execute();
    
            $dados = $statement->fetch(PDO::FETCH_ASSOC);
    
            return $this->formarObjeto($dados);
        }

        public function idPeloTitulo(string $titulo): int  {
            $sql = "SELECT * FROM filmes WHERE titulo = ?";
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(1,$titulo);
            $statement->execute();
    
            $dados = $statement->fetch(PDO::FETCH_ASSOC);
            
            return $dados['id'];
        }

        public function deletar(int $id){
            $imagensRepositorio = new ImagensRepositorio($this->pdo);
            $imagensRepositorio->deletar($id);
            $elencoRepositorio = new elencoRepositorio($this->pdo);
            $elencoRepositorio->deletar($id);
            $sql = "DELETE FROM filmes WHERE id = ?";
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(1,$id);
            $statement->execute();
    
        }
    
        public function salvar(Filme $filme)  {
            $sql = "INSERT INTO filmes (titulo, comentario, sinopse, clasificacao, nota) VALUES (?,?,?,?,?)";
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(1, $filme->getTitulo());
            $statement->bindValue(2, $filme->getComentario());
            $statement->bindValue(3, $filme->getSinopse());
            $statement->bindValue(4,$filme->getClasificacao());
            $statement->bindValue(5, $filme->getNota());
            $statement->execute();
            $id = $this->idPeloTitulo($filme->getTitulo());
            $imagensRepositorio = new ImagensRepositorio($this->pdo);
            $imagensRepositorio->salvar($filme->getImagens(),$id);
            $elencoRepositorio = new elencoRepositorio($this->pdo);
            $elencoRepositorio->salvar($filme->getElenco(), $id);
        }

        public function atualizar(Filme $filme) {
            $sql = "UPDATE filmes SET titulo = ?, comentario = ?, sinopse = ?, clasificacao = ?, nota = ? WHERE id = ?";
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(1, $filme->getTitulo());
            $statement->bindValue(2, $filme->getComentario());
            $statement->bindValue(3, $filme->getSinopse());
            $statement->bindValue(4, $filme->getClasificacao());
            $statement->bindValue(5, $filme->getNota());
            $statement->bindValue(6, $filme->getId());
            $statement->execute();
            $imagensRepositorio = new ImagensRepositorio($this->pdo);
            $imagensRepositorio->atualizar($filme->getImagens());
            $elencoRepositorio = new elencoRepositorio($this->pdo);
            $elencoRepositorio->atualizar($filme->getElenco(), $filme->getId());
        }
    }
?>