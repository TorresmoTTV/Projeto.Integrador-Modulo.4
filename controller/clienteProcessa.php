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
                header('Location: ../index.php');
            } else {
                $error = "Erro ao registrar usuário. Tente novamente.";
            }
        }
    }
}
//excluir conta cliente
function excluirConta()
{
    require '../DAO/conexao.php';

    // Verifica se o usuário está logado
    if (!isset($_SESSION['user_id'])) {
        header('Location: ../index.php');
        exit();
    }

    $idUsuario = $_SESSION['user_id'];

    // Exclui o usuário da tabela cliente
    $stmt = $pdo->prepare("DELETE FROM cliente WHERE IDUsuario = ?");
    if ($stmt->execute([$idUsuario])) {
        // Encerra a sessão e redireciona
        session_unset();
        session_destroy();
        header('Location: ../index.php');
        exit();
    } else {
        echo "<script>alert('Erro ao excluir a conta. Tente novamente.');</script>";
    }
}

//alterar conta cliente
function atualizarConta()
{
    require '../DAO/conexao.php';

    if (!isset($_SESSION['user_id'])) {
        header('Location: ../index.php');
        exit();
    }

    $idUsuario = $_SESSION['user_id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $endereco = $_POST['endereco'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    // Verifica se o nome de usuário já existe para outro usuário
    $stmt = $pdo->prepare("SELECT IDUsuario FROM cliente WHERE UsuarioCliente = ? AND IDUsuario != ?");
    $stmt->execute([$usuario, $idUsuario]);
    if ($stmt->fetch()) {
        echo "<script>alert('Nome de usuário já está em uso por outro cliente.'); window.location.href='editar-cliente.php';</script>";
        exit();
    }

    // Atualiza com ou sem alteração de senha
    if (!empty($senha)) {
        $senhaHash = password_hash($senha, PASSWORD_BCRYPT);
        $sql = "UPDATE cliente SET Nome = ?, Email = ?, Endereco = ?, CPF = ?, Telefone = ?, UsuarioCliente = ?, Senha = ? WHERE IDUsuario = ?";
        $params = [$nome, $email, $endereco, $cpf, $telefone, $usuario, $senhaHash, $idUsuario];
    } else {
        $sql = "UPDATE cliente SET Nome = ?, Email = ?, Endereco = ?, CPF = ?, Telefone = ?, UsuarioCliente = ? WHERE IDUsuario = ?";
        $params = [$nome, $email, $endereco, $cpf, $telefone, $usuario, $idUsuario];
    }

    $stmt = $pdo->prepare($sql);
    if ($stmt->execute($params)) {
        echo "<script>alert('Conta atualizada com sucesso.'); window.location.href='page-cliente.php';</script>";
    } else {
        echo "<script>alert('Erro ao atualizar conta.');</script>";
    }
}


function entrarCliente()
{
    require 'DAO/conexao.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $stmt = $pdo->prepare("SELECT * FROM cliente WHERE UsuarioCliente = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['Senha'])) {
            $_SESSION['user_id'] = $user['IDUsuario'];
            $_SESSION['username'] = $user['UsuarioCliente'];
            header('Location: view/page-cliente.php');
            exit();
        } else {
            $error = 'Nome de usuário ou senha inválidos';
        }//erro fim
    }
}

function sairCliente()
{
    session_start();
    session_unset();
    session_destroy();
    header('Location: ../index.php');
    exit();
}
?>