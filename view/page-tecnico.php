<?php
session_start();
require '../DAO/conexao.php';
require '../controller/loginadmtecProcessa.php';
require '../controller/tecnicoProcessa.php';

if (!isset($_SESSION['user_id']) || $_SESSION['tipo'] !== 'tecnico') {
    sairTecAd();
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style-tecpage.css">
    <link rel="stylesheet" href="../styles/style.css">
    <title>Projeto/Ordens de Serviço - Técnico</title>
</head>

<body>
    <header>
        <div>
            <a href="gerenciar-os.php">
                <button id="button-head">Criar/Editar</button></a>
        </div>
        <h2 id="h2-center">
            Ordens de Serviço
        </h2>
        <div>
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['logout'])) {
                sairTecAd();
            }
            ?>
            <form method="POST" style="display:inline;">
                <button type="submit" name="logout" id="button-sair">Sair</button>
            </form>
        </div>
    </header>
    <main>
        <div id="div-center">
            <?php echo gerarTabelaOrdensServico(); ?>
        </div>
    </main>
</body>

</html>