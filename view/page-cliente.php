<?php
session_start();
require '../DAO/conexao.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/stylecriarcli.css">
    <title>Seus Pedidos</title>
</head>

<body>
    <header>
        <h2>
            <img src="../img/logo.png" alt="Logo Empresa" id="logo-empresa">
        </h2>
        <h2>
            <p id="h2-center">Seus Pedidos</p>
        </h2>
        <div id="div-center">
            <button type="submit" id="button-sair-cli" <?php
            require '../controller/clienteProcessa.php';
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                sairCliente();
            }
            ?>>Sair</button>
            </form>
            <a href="editar-cliente.php">
                <button id="button-head">Editar Conta</button>
            </a>
        </div>
    </header>
    <main>
        <div id="div-center">
            <table>
                <tr>
                    Número
                </tr>
                <tr>
                    Condição
                </tr>
                <tr>
                    Descrição
                </tr>
                <tr>
                    Data de Criação
                </tr>
                <tr>
                    Data de Finalização
                </tr>
                <tr>
                    Link Unboxing
                </tr>
            </table>
        </div>
    </main>
    <footer id="footer-info">
        <p>
            Contato: 4622-8922
            <br>
            Localização: Rua dos Tolos, 0, 00000-000, São Paulo.
        </p>
    </footer>
</body>

</html>