<?php

class clienteController
{
    public static function cadastrarCliente($Nome, $Email, $Endereco, $CPF, $Telefone, $UsuarioCliente, $Senha)
    {
        include '../model/clientemodel.php';
        $cli = new clientemodel($null, $Nome, $Email, $Endereco, $CPF, $Telefone, $UsuarioCliente, $Senha);
        $cli->cadastrarCliente($cli);
    }

    public static function listarClientes()
    {
        include '../model/clientemodel.php';
        $model = new clientemodel(null, null, null, null, null, null, null, null);
        return $model->listarClientes();
    }

    public static function resgataPorID($idUsuario)
    {
        include '../model/clientemodel.php';
        $model = new clientemodel(null, null, null, null, null, null, null, null);
        return $model->resgataPorID($idUsuario);
    }

    public static function alterarCliente($idUsuario, $Condicao, $Descricao, $LinkUnboxing, $DataInicio, $DataFim, $fk_Cliente_IDUsuario, $fk_Tecnico_IDTecnico)
    {
        include '../model/clientemodel.php';
        $cli = new clientemodel($idUsuario, $Condicao, $Descricao, $LinkUnboxing, $DataInicio, $DataFim, $fk_Cliente_IDUsuario, $fk_Tecnico_IDTecnico);
        $cli->alterarCliente($idUsuario);
    }

    public static function excluirCliente($idUsuario)
    {
        include '../model/clientemodel.php';
        $cli = new clientemodel(null, null, null, null, null, null, null, null);
        $cli->excluirCliente($idUsuario);
    }
}

?>