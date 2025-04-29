<?php
require_once '../DAO/administradorDAO.php';
require_once '../DAO/tecnicoDAO.php';

function entrarFuncionario()
{
    require '../DAO/conexao.php';
    global $pdo;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['usuario'];
        $password = $_POST['senha'];
    
        // Login Administrador
        $stmtAdmin = $pdo->prepare("SELECT * FROM Administrador WHERE UsuarioAdmin = ?");
        $stmtAdmin->execute([$username]);
        $admin = $stmtAdmin->fetch();
    
        if ($admin && password_verify($password, $admin['Senha'])) {
            $_SESSION['user_id'] = $admin['IDAdmin'];
            $_SESSION['username'] = $admin['UsuarioAdmin'];
            $_SESSION['tipo'] = 'admin';
            header('Location: area-administrador.php');
            exit();
        }
    
        // Login Técnico
        $stmtTec = $pdo->prepare("SELECT * FROM Tecnico WHERE UsuarioTec = ?");
        $stmtTec->execute([$username]);
        $tecnico = $stmtTec->fetch();
    
        if ($tecnico && password_verify($password, $tecnico['Senha'])) {
            $_SESSION['user_id'] = $tecnico['IDTecnico'];
            $_SESSION['username'] = $tecnico['UsuarioTec'];
            $_SESSION['tipo'] = 'tecnico';
            header('Location: page-tecnico.php');
            exit();
        }
    
        // Falha no login
        echo "<script>alert('Nome de usuário ou senha inválidos'); window.location.href='area-funcionario.php';</script>";
        exit();
    }
}

function sairTecAd()
{
    session_start();
    session_unset();
    session_destroy();
    header('Location: area-funcionario.php');
    exit();
}
