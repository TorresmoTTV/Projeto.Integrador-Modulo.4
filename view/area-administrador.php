<?php
session_start();
require '../DAO/conexao.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: area-funcionario.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/stylecriarcli.css">
    <link rel="stylesheet" href="../styles/btn-adm.css">
    <title>Área do Administrador</title>
</head>

<body>
    <header>
        <div class="menu">
            <button class="dropbtn" onclick="toggleDropdown()">☰</button>
            <div id="myDropdown" class="dropdown-content">
                <a href="criar-tecnico.php">Gerenciar Técnicos</a>
                <a href="gerenicar-os.php">Gerenciar Ordens de Serviço</a>
                <a href="#">Criar Relatórios</a>
            </div>
        </div>
        </div>
        <h2 id="h2-center">
            <p> Administração </p>
        </h2>
        <div>
            <button id="button-sair" onclick="sairTecAd()">Sair</button>
        </div>
    </header>
    <main>
        <h2 id="h2-center">
            Ordens de Serviço
        </h2>
        <h2 id="h2-center">
            Técnicos
        </h2>
        <h2 id="h2-center">
            Clientes
        </h2>
    </main>
    <script src="../scripts/scriptmenu.js"></script>
</body>

</html>