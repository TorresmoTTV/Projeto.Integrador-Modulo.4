<?php

class clientemodel
{
    protected $IDUsuario;
    protected $Nome;
    protected $Email;
    protected $Endereco;
    protected $CPF;
    protected $Telefone;
    protected $UsuarioCliente;
    protected $Senha;

    public function __construct($IDUsuario, $Nome, $Email, $Endereco, $CPF, $Telefone, $UsuarioCliente, $Senha)
    {
        $this->IDUsuario = $IDUsuario;
        $this->Nome = $Nome;
        $this->Email = $Email;
        $this->Endereco = $Endereco;
        $this->CPF = $CPF;
        $this->Telefone = $Telefone;
        $this->UsuarioCliente = $UsuarioCliente;
        $this->Senha = $Senha;
    }

    // Getter methods
    public function getIDUsuario()
    {
        return $this->IDUsuario;
    }

    public function getNome()
    {
        return $this->Nome;
    }

    public function getEmail()
    {
        return $this->Email;
    }

    public function getEndereco()
    {
        return $this->Endereco;
    }

    public function getCPF()
    {
        return $this->CPF;
    }

    public function getTelefone()
    {
        return $this->Telefone;
    }

    public function getUsuarioCliente()
    {
        return $this->UsuarioCliente;
    }

    public function getSenha()
    {
        return $this->Senha;
    }

    // Setter methods
    public function setIDUsuario($IDUsuario)
    {
        $this->IDUsuario = $IDUsuario;
    }

    public function setNome($Nome)
    {
        $this->Nome = $Nome;
    }

    public function setEmail($Email)
    {
        $this->Email = $Email;
    }

    public function setEndereco($Endereco)
    {
        $this->Endereco = $Endereco;
    }

    public function setCPF($CPF)
    {
        $this->CPF = $CPF;
    }

    public function setTelefone($Telefone)
    {
        $this->Telefone = $Telefone;
    }

    public function setUsuarioCliente($UsuarioCliente)
    {
        $this->UsuarioCliente = $UsuarioCliente;
    }

    public function setSenha($Senha)
    {
        $this->Senha = $Senha;
    }

    
    public function cadastrarCliente(clientemodel $cliente)
    {
        include_once '../DAO/clienteDAO.php';
        $admin = new ClienteDAO();
        $admin->cadastrarCliente($this);
    }

    public function listarClientes()
    {
        include '../DAO/clienteDAO.php';
        $dao = new ClienteDAO(null);
        return $dao->listarClientes();
    }

    public function resgataPorID($idUsuario)
    {
        include '../DAO/clienteDAO.php';
        $model = new ClienteDAO(null);
        return $model->resgataPorID($idUsuario);
    }

    public function alterarCliente(clientemodel $cliente)
    {
        include_once '../DAO/clienteDAO.php';
        $admin = new ClienteDAO();
        $admin->alterarCliente($this);
    }

    public function excluirCliente($idUsuario)
    {
        include_once '../DAO/clienteDAO.php';
        $admin = new ClienteDAO();
        $admin->excluirCliente($idUsuario);
    }
}

?>