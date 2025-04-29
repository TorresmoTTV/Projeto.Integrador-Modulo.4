<?php
session_start();
require '../DAO/conexao.php';
require '../controller/clienteProcessa.php';


if (!isset($_SESSION['user_id'])) {
    header('Location: area-cliente.php');
    exit();
}


$stmt = $pdo->prepare("SELECT * FROM cliente WHERE IDUsuario = ?");
$stmt->execute([$_SESSION['user_id']]);
$usuario = $stmt->fetch();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['excluir'])) {
        excluirConta();
    } elseif (isset($_POST['atualizar'])) {
        atualizarConta();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/stylecriarcli.css">
    <title>Editar Conta</title>
</head>

<body>
    <header>
        <h2>
            <img src="../img/logo.png" alt="Logo Empresa" id="logo-empresa">
        </h2>
        <h2>
            <p id="h2-right"> Editar Conta </p>
        </h2>
    </header>
    <main>
        <br><br>
        <form action="editar-cliente.php" method="POST" onsubmit="return confirmarAcao(event)">
            <div class="form-container">
                <div class="form-column">
                    <div class="form-group">
                        <label>Nome</label>
                        <input type="text" name="nome" value="<?= htmlspecialchars($usuario['Nome']) ?>" required maxlength="50">
                    </div>
                    <div class="form-group">
                        <label>E-mail</label>
                        <input type="email" name="email" value="<?= htmlspecialchars($usuario['Email']) ?>" required maxlength="50">
                    </div>
                    <div class="form-group">
                        <label>C.P.F</label>
                        <input type="text" name="cpf" value="<?= htmlspecialchars($usuario['CPF']) ?>" required maxlength="14">
                    </div>
                    <div class="form-group">
                        <label>Endereço</label>
                        <input type="text" name="endereco" value="<?= htmlspecialchars($usuario['Endereco']) ?>" required maxlength="100">
                    </div>
                </div>
                <div class="form-column">
                    <div class="form-group">
                        <label>Telefone</label>
                        <input type="tel" name="telefone" value="<?= htmlspecialchars($usuario['Telefone']) ?>" required maxlength="15">
                    </div>
                    <div class="form-group">
                        <label>Usuário</label>
                        <input type="text" name="usuario" value="<?= htmlspecialchars($usuario['UsuarioCliente']) ?>" required maxlength="30">
                    </div>
                    <div class="form-group">
                        <label>Senha <small style="color: #888;">(preencha apenas se quiser alterar)</small></label>
                        <input type="password" name="senha" maxlength="20">
                    </div>
                </div>
            </div>

            <div class="button-container">
                <button type="submit" name="excluir" class="btn-danger">Excluir Conta</button>
                <button type="submit" name="atualizar">Atualizar Conta</button>
            </div>
        </form>

        <div id="div-center">
            <a href="page-cliente.php">
                <button>Voltar para Pedidos</button>
            </a>
        </div>
        <br>
    </main>

    <footer id="footer-info">
        <p>
            Contato: 4622-8922
            <br>
            Localização: Rua dos Tolos, 0, 00000-000, São Paulo.
        </p>
    </footer>

    <script>
        function confirmarAcao(event) {
            if (event.submitter && event.submitter.name === 'excluir') {
                return confirm('Tem certeza que deseja excluir sua conta? Esta ação é irreversível.');
            }
            return true;
        }
    </script>
    <script src="../scripts/script.js"></script>
</body>

</html>
