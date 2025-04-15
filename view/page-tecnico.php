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
    <title>Projeto/Ordens de Serviço - Técnico</title>
</head>

<body>
    <header>
        <div>
            <a href="gerenicar-os.php">
                <button id="button-head">Criar/Editar</button></a>
        </div>
        <h2 id="h2-center">
            Ordens de Serviço
        </h2>
        <div>
                <button id="button-sair" onclick="sairTecAd()">Sair</button>
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
            <tr>
                Cliente
            </tr>
            <tr>
                Técnico
            </tr>
        </table>
        </div>
    </main>
</body>

</html>