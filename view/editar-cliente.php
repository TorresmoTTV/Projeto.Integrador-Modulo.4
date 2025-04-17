<?php
session_start();
require '../DAO/conexao.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.html');
    exit();
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
        <form action="editar-cliente.php" method="POST">
            <div class="form-container">
                <div class="form-column">
                    <div class="form-group">
                        <label>Nome</label>
                        <input type="text" name="nome" required maxlength="50">
                    </div>
                    <div class="form-group">
                        <label>E-mail</label>
                        <input type="email" name="email" required maxlength="50">
                    </div>
                    <div class="form-group">
                        <label>C.P.F</label>
                        <input type="text" name="cpf" required maxlength="14">
                    </div>
                    <div class="form-group">
                        <label>Endereço</label>
                        <input type="text" name="endereco" required maxlength="100">
                    </div>
                </div>
                <div class="form-column">
                    <div class="form-group">
                        <label>Telefone</label>
                        <input type="tel" name="telefone" required maxlength="15">
                    </div>
                    <div class="form-group">
                        <label>Usuário</label>
                        <input type="text" name="usuario" required maxlength="30">
                    </div>
                    <div class="form-group">
                        <label>Senha</label>
                        <input type="password" name="senha" required maxlength="20">
                    </div>
                </div>
            </div>
            <div class="button-container">
                <button type="submit" onclick="excluirConta()">Excluir Conta</button>
                <button type="submit" onclick="atualizarConta()">Atualizar Conta</button>
            </div>
        </form>
        <div>
            <div id="div-center">
                <a href="page-cliente.php">
                    <button>Voltar para Pedidos</button></a>
            </div>
        </div>
    </main>
    <footer id="footer-info">
        <p>
            Contato: 4622-8922
            <br>
            Localização: Rua dos Tolos, 0, 00000-000, São Paulo.
        </p>
    </footer>
    <script src="../scripts/script.js"></script>
</body>

</html>