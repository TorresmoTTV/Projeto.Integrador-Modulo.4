<?php
session_start();
require '../DAO/conexao.php';
require '../controller/clientetabela.php';


if (!isset($_SESSION['user_id'])) {
    header('Location: area-cliente.php');
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
            <?php
            require '../controller/clienteProcessa.php';
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['logout'])) {
                sairCliente();
            }
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
            <table border="1">
                <tr>
                    <th>Número</th>
                    <th>Condição</th>
                    <th>Descrição</th>
                    <th>Data de Criação</th>
                    <th>Data de Finalização</th>
                    <th>Link Unboxing</th>
                </tr>
                <?php buscarPedidosPorCliente($conexao, $_SESSION['user_id']); ?>
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