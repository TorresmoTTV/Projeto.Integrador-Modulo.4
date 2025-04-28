<?php
require_once '../DAO/administradorDAO.php';
require_once '../DAO/tecnicoDAO.php';

function entrarFuncionario()
{
    require '../DAO/conexao.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];
    
        // Primeiro tenta login como Administrador
        $stmtAdmin = $pdo->prepare("SELECT * FROM Administrador WHERE UsuarioAdmin = ?");
        $stmtAdmin->execute([$username]);
        $admin = $stmtAdmin->fetch();
    
        if ($admin && password_verify($password, $admin['Senha'])) {
            $_SESSION['user_id'] = $admin['IDAdmin'];
            $_SESSION['username'] = $admin['UsuarioAdmin'];
            $_SESSION['tipo'] = 'admin'; // Salva o tipo de usuário na sessão
            header('Location: page-admin.php'); // Redireciona para página do Administrador
            exit();
        }
    
        // Se não for Administrador, tenta login como Técnico
        $stmtTec = $pdo->prepare("SELECT * FROM Tecnico WHERE UsuarioTec = ?");
        $stmtTec->execute([$username]);
        $tecnico = $stmtTec->fetch();
    
        if ($tecnico && password_verify($password, $tecnico['Senha'])) {
            $_SESSION['user_id'] = $tecnico['IDTecnico'];
            $_SESSION['username'] = $tecnico['UsuarioTec'];
            $_SESSION['tipo'] = 'tecnico'; // Salva o tipo de usuário na sessão
            header('Location: page-funcionario.php'); // Redireciona para página do Técnico
            exit();
        }
    
        // Se não encontrou em nenhum dos dois
        echo "<script>alert('Nome de usuário ou senha inválidos'); window.location.href='area-funcionario.php';</script>";
        exit();
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