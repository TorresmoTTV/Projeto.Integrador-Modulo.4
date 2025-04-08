<?php

class TecnicoController
{
    public static function cadastrarTecnico($nome, $telefone, $email, $cpf, $usuariotec, $senha)
    {
        include '../model/tecnicomodel.php';
        $tec = new tecnicomodel($null,$nome, $telefone, $email, $cpf, $usuariotec, $senha);
        $tec->cadastrarTecnico($tec);
    }

    public static function listarTecnicos()
    {
        include '../model/tecnicomodel.php';
        $model = new tecnicomodel(null,null,null,null,null,null,null);
        return $model->listarTecnicos();
    }

    public static function resgataPorID($idTecnico)
    {
        include '../model/tecnicomodel.php';
        $model = new tecnicomodel(null,null,null,null,null,null,null);
        return $model->resgataPorID($idTecnico);
    }

    public static function alterarTecnico($idTecnico, $nome, $telefone, $email, $cpf, $usuarioTec, $senha)
    {
        include '../model/tecnicomodel.php';
        $tec = new tecnicomodel($idTecnico, $nome, $telefone, $email, $cpf, $usuarioTec, $senha);
        $tec->alterarTecnico($tec);
    }

    public static function excluirTecnico($idTecnico)
    {
        include '../model/tecnicomodel.php';
        $tec = new tecnicomodel(null,null,null,null,null,null,null);
        $tec->excluirTecnico($idTecnico);
    }
}

?>