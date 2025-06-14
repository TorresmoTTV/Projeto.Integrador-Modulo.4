<?php
session_start();
require '../controller/clienteProcessa.php';
require '../DAO/conexao.php';


if (!isset($_SESSION['user_id'])|| $_SESSION['tipo'] !== 'cliente') {
    sairCliente();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['logout'])) {
    sairCliente();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/style-card.css">
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
            <?php


            ?>
            <form method="POST" style="display:inline;">
                <button type="submit" name="logout" id="button-sair-cli">Sair</button>
            </form>
            <a href="editar-cliente.php">
                <button id="button-head">Editar Conta</button>
            </a>
        </div>
    </header>
    <main>
            <div id="div-center">
                <?php buscarPedidosPorCliente($pdo, $_SESSION['user_id']); ?>
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