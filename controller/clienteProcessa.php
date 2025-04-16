<?php
//criar conta cliente
function criarConta()
{
    require '../DAO/conexao.php';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $endereco = $_POST['endereco'];
        $cpf = $_POST['cpf'];
        $telefone = $_POST['telefone'];
        $username = $_POST['usuario'];
        $password = $_POST['senha'];

        $stmt = $pdo->prepare("SELECT * FROM cliente WHERE UsuarioCliente = ?");
        $stmt->execute([$username]);
        if ($stmt->fetch()) {
            $error = 'Nome do usuário já existe.';
        } else {
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $pdo->prepare('INSERT INTO cliente (Nome, Email, Endereco, CPF, Telefone, UsuarioCliente, Senha) VALUES (?, ?, ?, ?, ?, ?, ?)');
            if ($stmt->execute([$nome, $email, $endereco, $cpf, $telefone, $username, $hashed_password])) {
                $sucess = 'Usuário registrado com sucesso. Você pode fazer login agora.';
            } else {
                $error = "Erro ao registrar usuário. Tente novamente.";
            }
        }
    }
}
//excluir conta cliente
function excluirConta()
{

}
//alterar conta cliente
function atualizarConta()
{

}
function entrarCliente()
{
    require '../DAO/conexao.php';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $stmt = $pdo->prepare("SELECT * FROM cliente WHERE UsuarioCliente = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header('Location: view/page-cliente.php');
            exit();
        } else {
            $error = 'Nome de usuário ou senha inválidos';
        }
    }
}

function sairCliente()
{
    session_start();
    session_unset();
    session_destroy();
    header('Location: index.php');
    exit();
}
?>