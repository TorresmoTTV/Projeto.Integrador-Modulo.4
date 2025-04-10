<?php
require_once '../DAO/administradorDAO.php';
require_once '../DAO/tecnicoDAO.php';

function entrarFuncionario($login, $senha) {
    $aDAO = new AdministradorDAO();
    $admin = $aDAO->buscarAdministradorPorLoginSenha($login, $senha);
    if ($admin != null) {
        return $admin; // Retorna o administrador se encontrado
    }

    $tDAO = new TecnicoDAO();
    $tecnico = $tDAO->buscarTecnicoPorLoginSenha($login, $senha);
    if ($tecnico != null) {
        return $tecnico; // Retorna o técnico se encontrado
    }

    return null; // Se não for encontrado, retorna null
}

?>
