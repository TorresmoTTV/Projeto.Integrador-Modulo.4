<?php
session_start();
require '../DAO/conexao.php';

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <title>Criar Conta</title>
</head>

<body>
    <header>
        <h2>
            <img src="../img/logo.png" alt="Logo Empresa" id="logo-empresa">
        </h2>
        <h2>
            <p id="h2-right"> Criar Conta </p>
        </h2>
    </header>

    <main>
        <div id="div-center">
            <h3>Todos os campos são obrigatórios.</h3>
        </div>
        <?php
        require '../controller/clienteProcessa.php';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            criarConta();
        }
        ?>
        <form action="criar-cliente.php" method="POST">
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
                <button type="submit">Criar Conta</button>
            </div>
        </form>
        <br>
    </main>
    <footer id="footer-info">
        <p>
            Contato: 4622-8922 <br>
            Localização: Rua dos Tolos, 0, 00000-000, São Paulo.
        </p>
    </footer>
    <script src="../scripts/script.js"></script>
</body>

</html>