<?php

    class tecnico
    {
        protected $IDTecnico;
        protected $Nome;
        protected $Telefone;
        protected $Email;
        protected $CPF;
        protected $UsuarioTec;
        protected $Senha;

        public function __construct($IDTecnico, $Nome, $Telefone, $Email, $CPF, $UsuarioTec, $Senha)
        {
            $this->IDTecnico = $IDTecnico;
            $this->Nome = $Nome;
            $this->Telefone = $Telefone;
            $this->Email = $Email;
            $this->CPF = $CPF;
            $this->UsuarioTec = $UsuarioTec;
            $this->Senha = $Senha;
        }

        // Getter methods
        public function getIDTecnico() {
            return $this->IDTecnico;
        }

        public function getNome() {
            return $this->Nome;
        }

        public function getTelefone() {
            return $this->Telefone;
        }

        public function getEmail() {
            return $this->Email;
        }

        public function getCPF() {
            return $this->CPF;
        }

        public function getUsuarioTec() {
            return $this->UsuarioTec;
        }

        public function getSenha() {
            return $this->Senha;
        }

        // Setter methods
        public function setIDTecnico($IDTecnico) {
            $this->IDTecnico = $IDTecnico;
        }

        public function setNome($Nome) {
            $this->Nome = $Nome;
        }

        public function setTelefone($Telefone) {
            $this->Telefone = $Telefone;
        }

        public function setEmail($Email) {
            $this->Email = $Email;
        }

        public function setCPF($CPF) {
            $this->CPF = $CPF;
        }

        public function setUsuarioTec($UsuarioTec) {
            $this->UsuarioTec = $UsuarioTec;
        }

        public function setSenha($Senha) {
            $this->Senha = $Senha;
        }
    }

?>
