<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <title>Área de Login</title>
</head>

<body>
    <header>
        <h2>
            <img src="../img/logo.png" alt="Logo Empresa" id="logo-empresa">
        </h2>
        <h2>
            <p id="h2-right"> Área do Cliente </p>
        </h2>
    </header>
    <main>
    <br><br><br>
        <?php
        require '../controller/clienteProcessa.php';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            entrarCliente();
        }
        ?>
        <div id="form-container-wrapper">
            <form method="POST">
                <div id="form-container-login">
                    <div class="form-column">
                        <div class="form-group">
                            <label>Usuário</label>
                            <input type="text" name="username" required maxlength="30">
                        </div>
                        <div class="form-group">
                            <label>Senha</label>
                            <input type="password" name="password" required maxlength="20">
                        </div>
                    </div>
                </div>
                <div id="div-center">
                    <button type="submit">Entrar</button>
                </div>
            </form>
            <div id="div-center">
                <a href="criar-cliente.php">
                    <button>Criar Conta</button>
                </a>
            </div>
            <div id="div-center">
                <a href="area-funcionario.php">
                    <button>Área dos Funcionários</button>
                </a>
            </div>
        </div>
        <br><br><br><br>
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