<?php

    class Administrador
    {
        protected $IDAdmin;
        protected $UsuarioAdmin;
        protected $Senha;

        public function __construct($IDAdmin, $UsuarioAdmin, $Senha)
        {
            $this->IDAdmin = $IDAdmin;
            $this->UsuarioAdmin = $UsuarioAdmin;
            $this->Senha = $Senha;
        }

        // Getter methods
        public function getIDAdmin()
        {
            return $this->IDAdmin;
        }

        public function getUsuarioAdmin()
        {
            return $this->UsuarioAdmin;
        }

        public function getSenha()
        {
            return $this->Senha;
        }

        // Setter methods
        public function setIDAdmin($IDAdmin)
        {
            $this->IDAdmin = $IDAdmin;
        }

        public function setUsuarioAdmin($UsuarioAdmin)
        {
            $this->UsuarioAdmin = $UsuarioAdmin;
        }

        public function setSenha($Senha)
        {
            $this->Senha = $Senha;
        }
    }


?>
