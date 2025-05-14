<?php
session_start();
require '../DAO/conexao.php';
require '../controller/administradorProcessa.php';
require '../controller/loginadmtecProcessa.php';

if (!isset($_SESSION['user_id']) || $_SESSION['tipo'] !== 'admin') {
    sairTecAd();
}

$ordens = listarOS();
$tecnicos = listarTecnicos();
$clientes = listarClientes();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/btn-adm.css">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/style-adm.css">
    <title>Área do Administrador</title>
</head>

<body>
    <header>
        <div class="menu">
            <button class="dropbtn" onclick="toggleDropdown()">☰</button>
            <div id="myDropdown" class="dropdown-content">
                <a href="criar-tecnico.php">Gerenciar Técnicos</a>
                <a href="gerenciar-os.php">Gerenciar Ordens de Serviço</a>
                <div class="dropdown-relatorio">
                    <a href="#" onclick="toggleSubmenu(event)">Criar Relatórios ▸</a>
                    <div id="submenuRelatorio" class="submenu-relatorio">
                        <a href="../controller/relatorioProcessa.php?tipo=clientes"  target="_blank">Gerar PDF Clientes</a>
                        <a href="../controller/relatorioProcessa.php?tipo=tecnicos"  target="_blank">Gerar PDF Técnicos</a>
                        <a href="../controller/relatorioProcessa.php?tipo=os"  target="_blank">Gerar PDF O.S.</a>
                    </div>
                </div>
            </div>
        </div>
        <h2 id="h2-center">
            <p> Administração </p>
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
        <div class="container-centralizado">
            <h2 id="h2-center">Ordens de Serviço</h2>
            <div class="table-scroll-container">
                <br>
                <table class="tabela-adm">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Condição</th>
                            <th>Descrição</th>
                            <th>Link Unboxing</th>
                            <th>Data Início</th>
                            <th>Data Fim</th>
                            <th>ID Cliente</th>
                            <th>ID Técnico</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($ordens as $os): ?>
                            <tr>
                                <td><?= htmlspecialchars($os['IDOs']) ?></td>
                                <td><?= htmlspecialchars($os['Condicao']) ?></td>
                                <td><?= htmlspecialchars($os['Descricao']) ?></td>
                                <td>
                                    <?php if (!empty($os['LinkUnboxing'])): ?>
                                        <a href="<?= htmlspecialchars($os['LinkUnboxing']) ?>" target="_blank">Abrir Link</a>
                                    <?php else: ?>
                                        —
                                    <?php endif; ?>
                                </td>
                                <td><?= htmlspecialchars($os['DataInicio']) ?></td>
                                <td><?= htmlspecialchars($os['DataFim']) ?></td>
                                <td><?= htmlspecialchars($os['fk_Cliente_IDUsuario']) ?></td>
                                <td><?= htmlspecialchars($os['fk_Tecnico_IDTecnico']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <h2 id="h2-center">Tabela de Técnicos</h2>
            <div class="table-scroll-container">
                <br>
                <table class="tabela-adm">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Telefone</th>
                            <th>Email</th>
                            <th>CPF</th>
                            <th>Usuário</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tecnicos as $tecnico): ?>
                            <tr>
                                <td><?= htmlspecialchars($tecnico['IDTecnico']) ?></td>
                                <td><?= htmlspecialchars($tecnico['Nome']) ?></td>
                                <td><?= htmlspecialchars($tecnico['Telefone']) ?></td>
                                <td><?= htmlspecialchars($tecnico['Email']) ?></td>
                                <td><?= htmlspecialchars($tecnico['CPF']) ?></td>
                                <td><?= htmlspecialchars($tecnico['UsuarioTec']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <h2 id="h2-center">Tabela de Clientes</h2>
            <div class="table-scroll-container">
                <br>
                <table class="tabela-adm">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Endereco</th>
                            <th>Telefone</th>
                            <th>CPF</th>
                            <th>Usuário</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($clientes as $cliente): ?>
                            <tr>
                                <td><?= htmlspecialchars($cliente['IDUsuario']) ?></td>
                                <td><?= htmlspecialchars($cliente['Nome']) ?></td>
                                <td><?= htmlspecialchars($cliente['Email']) ?></td>
                                <td><?= htmlspecialchars($cliente['Endereco']) ?></td>
                                <td><?= htmlspecialchars($cliente['Telefone']) ?></td>
                                <td><?= htmlspecialchars($cliente['CPF']) ?></td>
                                <td><?= htmlspecialchars($cliente['UsuarioCliente']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <script src="../scripts/scriptmenu.js"></script>
</body>

</html>