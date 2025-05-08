<?php
session_start();
require '../DAO/conexao.php';
require '../controller/loginadmtecProcessa.php';

if (!isset($_SESSION['user_id']) || $_SESSION['tipo'] !== 'admin') {
    sairTecAd();
}

$tecnicoEmEdicao = $_SESSION['tecnico_em_edicao'] ?? null;
$modo = $_SESSION['modo'] ?? 'criar';
$textoBotao = ($modo === 'editar') ? 'Editar Técnico' : 'Salvar';
$valorAcao = ($modo === 'editar') ? 'editarConfirmado' : 'criar';

// Consultar todos os técnicos
$sql = "SELECT * FROM Tecnico";
$stmt = $pdo->prepare($sql);
$stmt->execute();

// Armazenar os resultados da consulta
$tecnicos = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_GET['acao'] ?? '' === 'cancelar') {
    unset($_SESSION['tecnico_em_edicao']);
    unset($_SESSION['modo']);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/stylecriarcli.css">
    <link rel="stylesheet" href="../styles/style-criatec.css">
    <title>Gerenciar Técnicos</title>
</head>
<body>
    <header>
        <h2><img src="../img/logo.png" alt="Logo Empresa" id="logo-empresa"></h2>
        <h2>
            <p id="h2-right">Gerenciar</p>
            <p id="h2-right">Técnicos</p>
        </h2>
    </header>

    <div class="pagina-central">
        <div class="container-centralizado">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>CPF</th>
                        <th>Telefone</th>
                        <th>Usuário</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tecnicos as $tecnico): ?>
                        <tr class="linha-tecnico" data-id="<?= $tecnico['IDTecnico'] ?>" data-nome="<?= $tecnico['Nome'] ?>"
                            data-email="<?= $tecnico['Email'] ?>" data-cpf="<?= $tecnico['CPF'] ?>"
                            data-telefone="<?= $tecnico['Telefone'] ?>" data-usuario="<?= $tecnico['UsuarioTec'] ?>"
                            data-senha="<?= $tecnico['Senha'] ?>">
                            <td><?= $tecnico['IDTecnico'] ?></td>
                            <td><?= $tecnico['Nome'] ?></td>
                            <td><?= $tecnico['Email'] ?></td>
                            <td><?= $tecnico['CPF'] ?></td>
                            <td><?= $tecnico['Telefone'] ?></td>
                            <td><?= $tecnico['UsuarioTec'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <form action="../controller/tecnicoProcessa.php" method="POST" class="form-column">
                <input type="hidden" name="id_tecnico" value="<?= $tecnicoEmEdicao['IDTecnico'] ?? '' ?>">
                <input type="hidden" name="acao" value="<?= $valorAcao ?>">

                <div class="form-group">
                    <label>Nome</label>
                    <input type="text" name="nome" required maxlength="50" value="<?= $tecnicoEmEdicao['Nome'] ?? '' ?>">
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" required maxlength="100" value="<?= $tecnicoEmEdicao['Email'] ?? '' ?>">
                </div>

                <div class="form-group">
                    <label>CPF</label>
                    <input type="text" name="cpf" required maxlength="14" value="<?= $tecnicoEmEdicao['CPF'] ?? '' ?>">
                </div>

                <div class="form-group">
                    <label>Telefone</label>
                    <input type="text" name="telefone" required maxlength="14" value="<?= $tecnicoEmEdicao['Telefone'] ?? '' ?>">
                </div>

                <div class="form-group">
                    <label>Usuário</label>
                    <input type="text" name="usuario" required maxlength="50" value="<?= $tecnicoEmEdicao['UsuarioTec'] ?? '' ?>">
                </div>

                <div class="form-group">
                    <label>Senha</label>
                    <input type="password" name="senha" required maxlength="255" value="<?= $tecnicoEmEdicao['Senha'] ?? '' ?>">
                </div>

                <div class="button-container">
                    <button type="submit"><?= $textoBotao ?></button>
                    <button type="button" onclick="window.location.href='criar-tecnico.php?acao=cancelar'">Cancelar</button>
                    <button type="button" onclick="window.history.back()">Voltar</button>
                </div>
            </form>
        </div>
    </div>

    <script src="../scripts/criar-tecnico.js"></script> <!-- Script externo -->
</body>
</html>
