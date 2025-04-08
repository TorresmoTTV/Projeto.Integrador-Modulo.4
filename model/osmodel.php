<?php

class osmodel
{
    protected $IDOs;
    protected $Condicao;
    protected $Descricao;
    protected $LinkUnboxing;
    protected $DataInicio; // verificar o LocalDate
    protected $DataFim; // verificar o LocalDate
    protected $fk_Cliente_IDUsuario;
    protected $fk_Tecnico_IDTecnico;

    public function __construct($IDOs, $Condicao, $Descricao, $LinkUnboxing, $DataInicio, $DataFim, $fk_Cliente_IDUsuario, $fk_Tecnico_IDTecnico)
    {
        $this->IDOs = $IDOs;
        $this->Condicao = $Condicao;
        $this->Descricao = $Descricao;
        $this->LinkUnboxing = $LinkUnboxing;
        $this->DataInicio = $DataInicio;
        $this->DataFim = $DataFim;
        $this->fk_Cliente_IDUsuario = $fk_Cliente_IDUsuario;
        $this->fk_Tecnico_IDTecnico = $fk_Tecnico_IDTecnico;
    }

    // Getter methods
    public function getIDOs()
    {
        return $this->IDOs;
    }

    public function getCondicao()
    {
        return $this->Condicao;
    }

    public function getDescricao()
    {
        return $this->Descricao;
    }

    public function getLinkUnboxing()
    {
        return $this->LinkUnboxing;
    }

    public function getDataInicio()
    {
        return $this->DataInicio;
    }

    public function getDataFim()
    {
        return $this->DataFim;
    }

    public function getFkClienteIDUsuario()
    {
        return $this->fk_Cliente_IDUsuario;
    }

    public function getFkTecnicoIDTecnico()
    {
        return $this->fk_Tecnico_IDTecnico;
    }

    // Setter methods
    public function setIDOs($IDOs)
    {
        $this->IDOs = $IDOs;
    }

    public function setCondicao($Condicao)
    {
        $this->Condicao = $Condicao;
    }

    public function setDescricao($Descricao)
    {
        $this->Descricao = $Descricao;
    }

    public function setLinkUnboxing($LinkUnboxing)
    {
        $this->LinkUnboxing = $LinkUnboxing;
    }

    public function setDataInicio($DataInicio)
    {
        $this->DataInicio = $DataInicio;
    }

    public function setDataFim($DataFim)
    {
        $this->DataFim = $DataFim;
    }

    public function setFkClienteIDUsuario($fk_Cliente_IDUsuario)
    {
        $this->fk_Cliente_IDUsuario = $fk_Cliente_IDUsuario;
    }

    public function setFkTecnicoIDTecnico($fk_Tecnico_IDTecnico)
    {
        $this->fk_Tecnico_IDTecnico = $fk_Tecnico_IDTecnico;
    }

    public function cadastrarOS(OSmodel $OS)
    {
        include_once '../DAO/OSDAO.php';
        $admin = new OSDAO();
        $admin->cadastrarOS($this);
    }

    public function listarOS()
    {
        include '../DAO/OSDAO.php';
        $dao = new OSDAO(null);
        return $dao->listarOS();
    }

    public function resgataPorID($idOS)
    {
        include '../DAO/OSDAO.php';
        $model = new OSDAO(null);
        return $model->resgataPorID($idOS);
    }

    public function alterarOS(OSmodel $OS)
    {
        include_once '../DAO/OSDAO.php';
        $admin = new OSDAO();
        $admin->alterarOS($this);
    }

    public function excluirOS($idOS)
    {
        include_once '../DAO/OSDAO.php';
        $admin = new OSDAO();
        $admin->excluirOS($idOS);
    }
}

?>