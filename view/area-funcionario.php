<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/stylecriarcli.css">
    <title>Área do Funcionário</title>
</head>

<body>
    <header>
        <h2>
            <img src="../img/logo.png" alt="Logo Empresa" id="logo-empresa">
        </h2>
        <h2>
            <p id="h2-right"> Área do Funcionário </p>
        </h2>
    </header>
    <br>
    <main>
        <form action="area-funcionario.html" method="POST">
            <div id="form-container-login">
                <div class="form-column">
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
            <div id="div-center">
                <button type="submit" onclick="entrarFuncionario()">Entrar</button>
            </div>
        </form>
        <div id="div-center">
            <a href="../index.php">
                <button>Área Cliente</button>
            </a>
        </div>
    </main>
    <br><br><br><br><br><br><br>
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