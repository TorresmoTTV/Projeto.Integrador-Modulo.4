<?php
require_once '../DAO/administradorDAO.php';
require_once '../DAO/tecnicoDAO.php';

function entrarFuncionario()
{
    require 'DAO/conexao.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $stmt = $pdo->prepare("SELECT * FROM tecnico WHERE UsuarioTec = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['Senha'])) {
            $_SESSION['user_id'] = $user['IDTecnico'];
            $_SESSION['username'] = $user['UsuarioTec'];
            header('Location: view/page-cliente.php');
            exit();
        } else {
            $error = 'Nome de usuário ou senha inválidos';
        }
    }
}

function sairTecAd()
{
    session_start();
    session_unset();
    session_destroy();
    header('Location: view/area-funcionario.php');
    exit();
}
?>