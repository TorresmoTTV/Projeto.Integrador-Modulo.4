<?php

class tecnicomodel
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
    public function getIDTecnico()
    {
        return $this->IDTecnico;
    }

    public function getNome()
    {
        return $this->Nome;
    }

    public function getTelefone()
    {
        return $this->Telefone;
    }

    public function getEmail()
    {
        return $this->Email;
    }

    public function getCPF()
    {
        return $this->CPF;
    }

    public function getUsuarioTec()
    {
        return $this->UsuarioTec;
    }

    public function getSenha()
    {
        return $this->Senha;
    }

    // Setter methods
    public function setIDTecnico($IDTecnico)
    {
        $this->IDTecnico = $IDTecnico;
    }

    public function setNome($Nome)
    {
        $this->Nome = $Nome;
    }

    public function setTelefone($Telefone)
    {
        $this->Telefone = $Telefone;
    }

    public function setEmail($Email)
    {
        $this->Email = $Email;
    }

    public function setCPF($CPF)
    {
        $this->CPF = $CPF;
    }

    public function setUsuarioTec($UsuarioTec)
    {
        $this->UsuarioTec = $UsuarioTec;
    }

    public function setSenha($Senha)
    {
        $this->Senha = $Senha;
    }

    public function cadastrarTecnico(tecnicomodel $Tecnico)
    {
        include_once '../DAO/tecnicoDAO.php';
        $admin = new TecnicoDAO();
        $admin->cadastrarTecnico($this);
    }

    public function listarTecnicos()
    {
        include '../DAO/tecnicoDAO.php';
        $dao = new TecnicoDAO(null);
        return $dao->listarTecnicos();
    }

    public function resgataPorID($idTecnico)
    {
        include '../DAO/tecnicoDAO.php';
        $model = new TecnicoDAO(null);
        return $model->resgataPorID($idTecnico);
    }

    public function alterarTecnico(tecnicomodel $Tecnico)
    {
        include_once '../DAO/tecnicoDAO.php';
        $admin = new TecnicoDAO();
        $admin->alterarTecnico($this);
    }

    public function excluirTecnico($idTecnico)
    {
        include_once '../DAO/tecnicoDAO.php';
        $admin = new TecnicoDAO();
        $admin->excluirTecnico($idTecnico);
    }
}

?>