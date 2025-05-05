<?php
session_start();
require '../DAO/conexao.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: area-funcionario.php');
    exit();
}

$osEmEdicao = $_SESSION['os_em_edicao'] ?? null;
$modo = $_SESSION['modo'] ?? 'criar';
$textoBotao = ($modo === 'editar') ? 'Editar OS' : 'Salvar';
$valorAcao = ($modo === 'editar') ? 'editarConfirmado' : 'criar';

// Consultar todas as ordens de serviço
$sql = "SELECT * FROM projeto_ordemdeservico";
$stmt = $pdo->prepare($sql);
$stmt->execute();

// Armazenar os resultados da consulta
$ordens = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_GET['acao'] ?? '' === 'cancelar') {
    unset($_SESSION['os_em_edicao']);
    unset($_SESSION['modo']);
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style-os.css">
    <link rel="stylesheet" href="../styles/stylecriarcli.css">
    <title>Gerenciar Ordens de Serviço</title>
</head>

<body>
    <header>
        <h2><img src="../img/logo.png" alt="Logo Empresa" id="logo-empresa"></h2>
        <h2>
            <p id="h2-right">Gerenciar</p>
            <p id="h2-right">Ordens de Serviço</p>
        </h2>
    </header>

    <div class="pagina-central">
        <div class="container-centralizado">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Condição</th>
                        <th>Descrição</th>
                        <th>Link Unboxing</th>
                        <th>Data Criação</th>
                        <th>Data Finalização</th>
                        <th>Cliente</th>
                        <th>Técnico</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ordens as $os): ?>
                        <tr class="linha-os" data-id="<?= $os['IDOs'] ?>" data-condicao="<?= $os['Condicao'] ?>"
                            data-descricao="<?= $os['Descricao'] ?>" data-linkunboxing="<?= $os['LinkUnboxing'] ?>"
                            data-datainicio="<?= $os['DataInicio'] ?>" data-datafim="<?= $os['DataFim'] ?>"
                            data-cliente="<?= $os['fk_Cliente_IDUsuario'] ?>"
                            data-tecnico="<?= $os['fk_Tecnico_IDTecnico'] ?>">
                            <td><?= $os['IDOs'] ?></td>
                            <td><?= $os['Condicao'] ?></td>
                            <td><?= $os['Descricao'] ?></td>
                            <td><?= $os['LinkUnboxing'] ?></td>
                            <td><?= $os['DataInicio'] ?></td>
                            <td><?= $os['DataFim'] ?></td>
                            <td><?= $os['fk_Cliente_IDUsuario'] ?></td>
                            <td><?= $os['fk_Tecnico_IDTecnico'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <form action="../controller/osProcessa.php" method="POST" class="form-column">
                <input type="hidden" name="id_os" value="<?= $osEmEdicao['IDOs'] ?? '' ?>">
                <input type="hidden" name="acao" value="<?= $valorAcao ?>">

                <div class="form-group">
                    <label>Condição</label>
                    <input type="text" name="condicao" required maxlength="50" value="<?= $osEmEdicao['Condicao'] ?? '' ?>">
                </div>

                <div class="form-group">
                    <label>Descrição</label>
                    <textarea name="descricao" required maxlength="255"><?= $osEmEdicao['Descricao'] ?? '' ?></textarea>
                </div>

                <div class="form-group">
                    <label>Link Unboxing</label>
                    <input type="text" name="linkUnboxing" required maxlength="255" value="<?= $osEmEdicao['LinkUnboxing'] ?? '' ?>">
                </div>

                <div class="form-group">
                    <label>Data de Criação</label>
                    <input type="date" name="dataCriacao" required value="<?= $osEmEdicao['DataInicio'] ?? '' ?>">
                </div>

                <div class="form-group">
                    <label>Data de Finalização</label>
                    <input type="date" name="dataFinalizacao" value="<?= $osEmEdicao['DataFim'] ?? '' ?>">
                </div>

                <div class="form-group">
                    <label>Cliente (ID)</label>
                    <input type="number" name="cliente" required value="<?= $osEmEdicao['fk_Cliente_IDUsuario'] ?? '' ?>">
                </div>

                <div class="form-group">
                    <label>Técnico (ID)</label>
                    <input type="number" name="tecnico" required value="<?= $osEmEdicao['fk_Tecnico_IDTecnico'] ?? '' ?>">
                </div>

                <div class="button-container">
                    <button type="submit"><?= $textoBotao ?></button>
                    <button type="button" onclick="window.location.href='gerenciar-os.php?acao=cancelar'">Cancelar</button>
                    <button type="button" onclick="window.history.back()">Voltar</button>
                </div>
            </form>
        </div>
    </div>

    <script src="../scripts/gerenciar-os.js"></script> <!-- Script externo -->
</body>

</html>
