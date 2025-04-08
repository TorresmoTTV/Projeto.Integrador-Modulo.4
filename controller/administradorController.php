<?php

class AdministradorController
{
    public static function cadastrarAdministrador($UsuarioAdmin, $Senha)
    {
        include '../model/administradormodel.php';
        $adm = new administradormodel($null,$UsuarioAdmin, $Senha);
        $adm->cadastrarAdministrador($adm);
    }

    public static function listarAdministradores()
    {
        include '../model/administradormodel.php';
        $model = new administradormodel(null,null,null);
        return $model->listarAdministradores();
    }

    public static function resgataPorID($IDAdmin)
    {
        include '../model/administradormodel.php';
        $model = new administradormodel(null,null,null);
        return $model->resgataPorID($IDAdmin);
    }

    public static function alterarAdministrador($IDAdmin, $UsuarioAdmin, $Senha)
    {
        include '../model/administradormodel.php';
        $adm = new administradormodel($IDAdmin, $UsuarioAdmin, $Senha);
        $adm->alterarAdministrador($adm);
    }

    public static function excluirAdministrador($IDAdmin)
    {
        include '../model/administradormodel.php';
        $adm = new administradormodel(null,null,null);
        $adm->excluirAdministrador($IDAdmin);
    }
}

?>