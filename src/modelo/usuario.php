<?php

    class Usuario{
        private string $nickname;
        private string $senha;

        public function __construct(string $nickname, string $senha) {
            $this->nickname = $nickname;
            $this->senha = $senha;
        }

        public function getNickname(): string{
            return $this->nickname;
        }

        public function getSenha(): string{
            return $this->senha;
        }
    };
?>