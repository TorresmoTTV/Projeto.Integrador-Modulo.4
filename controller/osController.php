<?php

class osController
{
    public static function cadastrarOS($Condicao, $Descricao, $LinkUnboxing, $DataInicio, $DataFim, $fk_Cliente_IDUsuario, $fk_Tecnico_IDTecnico)
    {
        include '../model/osmodel.php';
        $os = new osModel($null, $Condicao, $Descricao, $LinkUnboxing, $DataInicio, $DataFim, $fk_Cliente_IDUsuario, $fk_Tecnico_IDTecnico);
        $os->cadastrarOS($os);
    }

    public static function listarOS()
    {
        include '../model/osmodel.php';
        $model = new osModel(null, null, null, null, null, null, null, null);
        return $model->listarOS();
    }

    public static function resgataPorID($idOS)
    {
        include '../model/osmodel.php';
        $model = new osModel(null, null, null, null, null, null, null, null);
        return $model->resgataPorID($idOS);
    }

    public static function alterarOS($IDos, $Condicao, $Descricao, $LinkUnboxing, $DataInicio, $DataFim, $fk_Cliente_IDUsuario, $fk_Tecnico_IDTecnico)
    {
        include '../model/osmodel.php';
        $os = new osModel($IDos, $Condicao, $Descricao, $LinkUnboxing, $DataInicio, $DataFim, $fk_Cliente_IDUsuario, $fk_Tecnico_IDTecnico);
        $os->alterarOS($IDos);
    }

    public static function excluirOS($idOS)
    {
        include '../model/osmodel.php';
        $os = new osModel(null, null, null, null, null, null, null, null);
        $os->excluirOS($idOS);
    }
}

?>