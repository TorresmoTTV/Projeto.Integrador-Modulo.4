<?php

class administradormodel
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

    public function cadastrarAdministrador(administradormodel $administrador)
    {
        include_once '../DAO/AdministradorDAO.php';
        $admin = new AdministradorDAO();
        $admin->cadastrarAdministrador($this);
    }

    public function listarAdministradores()
    {
        include '../DAO/AdministradorDAO.php';
        $dao = new AdministradorDAO(null);
        return $dao->listarAdministradores();
    }

    public function resgataPorID($idAdministrador)
    {
        include '../DAO/AdministradorDAO.php';
        $model = new AdministradorDAO(null);
        return $model->resgataPorID($idAdministrador);
    }

    public function alterarAdministrador(administradormodel $administrador)
    {
        include_once '../DAO/AdministradorDAO.php';
        $admin = new AdministradorDAO();
        $admin->alterarAdministrador($this);
    }

    public function excluirAdministrador($idAdministrador)
    {
        include_once '../DAO/AdministradorDAO.php';
        $admin = new AdministradorDAO();
        $admin->excluirAdministrador($idAdministrador);
    }
}
?>