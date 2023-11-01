<?php

    require_once ("src/modelo/usuario.php");

    class UsuarioRepositorio{
        private PDO $pdo;

        public function __construct(PDO $pdo){
            $this->pdo = $pdo;
        }

        private function formarObjeto($dados)
        {
            return new Usuario($dados['nickname'],
                $dados['senha']);
        }

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

        public function autenticar(string $nickname, string $senha): Bool{
            $usuario = $this->buscarPorNickname($nickname());
            if($usuario != False) {
                if($usuario->getSenha() == $senha()){
                    session_start();
                    $_SESSION['usuario_logado'] = $usuario->getNickname();
                    return True;
                }
            }
            return False;
        }

    }
?>