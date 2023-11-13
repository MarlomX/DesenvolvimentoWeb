<?php
    //Importa usuario
    require_once ("src/modelo/usuario.php");

    /*
    classe que faz a conexão com a tabela usuario do banco de dados:
    adicionando, buscando, alterando, deletando, entre outras funções
    */ 
    class UsuarioRepositorio{
        //atributo pdo se refere a coneção dele com o banco de dados
        private PDO $pdo;

        public function __construct(PDO $pdo){
            $this->pdo = $pdo;
        }

        // pega um usuario do banco de dados e transforma em um objeto Usuario
        private function formarObjeto($dados)
        {
            return new Usuario($dados['nickname'],
                $dados['senha']);
        }

        //busca um usuario do banco de dados referete ao seu nickname
        public function buscarPorNickname(string $nickname)  {
            $sql = "SELECT * FROM usuarios WHERE nickname = ?";
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(1,$nickname);
            $statement->execute();
    
            $dados = $statement->fetch(PDO::FETCH_ASSOC);
            
            if ($dados == False) {
                return  False;
            }

            return $this->formarObjeto($dados);
        }

        //verifica se existe um usuario no banco de dados com nickname e senha correspondente
        public function autenticar(string $nickname, string $senha): Bool{
            $usuario = $this->buscarPorNickname($nickname);
            if($usuario != False) {
                if($usuario->getSenha() == $senha){
                    session_start();
                    $_SESSION['usuario_logado'] = $usuario->getNickname();
                    return True;
                }
            }
            return False;
        }

    }
?>