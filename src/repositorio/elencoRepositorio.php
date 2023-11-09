<?php
    
    class ElencoRepositorio{
        private PDO $pdo;

        public function __construct(PDO $pdo) {
            $this->pdo = $pdo;
        }

        public function buscaElenco(int $id): array{
            $sql = "SELECT * FROM elenco WHERE id_filme = ?";
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(1,$id);
            $statement->execute();
    
            $lista = $statement->fetch(PDO::FETCH_ASSOC);
            array_shift($lista);
            $listaFiltrada = array();
            foreach ($lista as $elemento) {
                if ($elemento !== "placeholder") {
                    $listaFiltrada[] = $elemento;
                }
            }
            return $listaFiltrada;
        }

        public function deletar(int $id){
            $sql = "DELETE FROM elenco WHERE id_filme = ?";
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(1,$id);
            $statement->execute();
    
        }
    
        public function salvar($elenco, int $id)  {
            while(count($elenco) < 12){
                $elenco[] = 'placeholder';
            }
            $sql = "INSERT INTO elenco (id_filme, elenco_1, elenco_2, elenco_3, elenco_4,
            elenco_5, elenco_6, elenco_7, elenco_8, elenco_9, elenco_10, elenco_11, elenco_12
            ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(1, $id);
            $statement->bindValue(2, $elenco[0]);
            $statement->bindValue(3, $elenco[1]);
            $statement->bindValue(4, $elenco[2]);
            $statement->bindValue(5, $elenco[3]);
            $statement->bindValue(6, $elenco[4]);
            $statement->bindValue(7, $elenco[5]);
            $statement->bindValue(8, $elenco[6]);
            $statement->bindValue(9, $elenco[7]);
            $statement->bindValue(10, $elenco[8]);
            $statement->bindValue(11, $elenco[9]);
            $statement->bindValue(12, $elenco[10]);
            $statement->bindValue(13, $elenco[11]);
            $statement->execute();
        }

        public function atualizar($elenco, int $id) {
            while(count($elenco) < 12){
                $elenco[] = 'placeholder';
            }
            $sql = "UPDATE elenco SET elenco_1 = ?, elenco_2 = ?, elenco_3 =?,
             elenco_4 = ?, elenco_5 = ?, elenco_6 = ?, elenco_7 = ?, elenco_8 =?,
              elenco_9 = ?, elenco_10 = ?, elenco_11 = ?, elenco_12 =? WHERE id_filme = ?";
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(1, $elenco[0]);
            $statement->bindValue(2, $elenco[1]);
            $statement->bindValue(3, $elenco[2]);
            $statement->bindValue(4, $elenco[3]);
            $statement->bindValue(5, $elenco[4]);
            $statement->bindValue(6, $elenco[5]);
            $statement->bindValue(7, $elenco[6]);
            $statement->bindValue(8, $elenco[7]);
            $statement->bindValue(9, $elenco[8]);
            $statement->bindValue(10, $elenco[9]);
            $statement->bindValue(11, $elenco[10]);
            $statement->bindValue(12, $elenco[11]);
            $statement->bindValue(13, $id);
            $statement->execute();
        }
    }
?>