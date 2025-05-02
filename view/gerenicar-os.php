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
$sql = "SELECT * FROM projeto_ordemdeservico";  // Ajuste a consulta conforme sua tabela real
$stmt = $pdo->prepare($sql);
$stmt->execute();

// Armazenar os resultados da consulta
$ordens = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/stylecriarcli.css">
    <style>
        .main-container {
            display: flex;
            justify-content: space-between;
            padding: 20px;
        }

        .form-column, .tabela-container {
            width: 48%;
        }

        .tabela-container table {
            width: 100%;
            border-collapse: collapse;
        }

        .tabela-container th, .tabela-container td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }

        .button-container {
            margin-top: 15px;
            display: flex;
            gap: 10px;
        }

        button {
            padding: 8px 12px;
            cursor: pointer;
        }
    </style>
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

    <div class="main-container">
        <!-- Formulário -->
        <form action="../processos/osProcessa.php" method="POST" class="form-column">
            <input type="hidden" name="id_os" value="<?= $osEmEdicao['IDOs'] ?? '' ?>">

            <div class="form-group">
                <label>Condição</label>
                <input type="text" name="condicao" required maxlength="50" value="<?= $osEmEdicao['Condicao'] ?? '' ?>">
            </div>

            <div class="form-group">
                <label>Descrição</label>
                <input type="text" name="descricao" required maxlength="50" value="<?= $osEmEdicao['Descricao'] ?? '' ?>">
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
                <button type="submit" name="acao" value="<?= $valorAcao ?>"><?= $textoBotao ?></button>
                <button type="submit" name="acao" value="prepararEdicao">Transformar em Editar</button>
                <button type="submit" name="acao" value="cancelar">Cancelar</button>
            </div>
        </form>

        <!-- Tabela -->
        <div class="tabela-container">
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
                        <tr class="linha-os" data-id="<?= $os['IDOs'] ?>" data-condicao="<?= $os['Condicao'] ?>" data-descricao="<?= $os['Descricao'] ?>" data-linkunboxing="<?= $os['LinkUnboxing'] ?>" data-datainicio="<?= $os['DataInicio'] ?>" data-datafim="<?= $os['DataFim'] ?>" data-cliente="<?= $os['fk_Cliente_IDUsuario'] ?>" data-tecnico="<?= $os['fk_Tecnico_IDTecnico'] ?>">
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
        </div>
    </div>

    <div style="text-align: center; margin: 20px;">
        <form action="../processos/osProcessa.php" method="POST">
            <input type="hidden" name="acao" value="voltar">
            <button type="submit">Voltar para Página Anterior</button>
        </form>
    </div>

    <script>
        // Seleciona todas as linhas da tabela com a classe 'linha-os'
        const linhas = document.querySelectorAll('.linha-os');
        
        // Itera sobre as linhas
        linhas.forEach(linha => {
            linha.addEventListener('click', function() {
                // Pega os dados da linha
                const idOs = this.getAttribute('data-id');
                const condicao = this.getAttribute('data-condicao');
                const descricao = this.getAttribute('data-descricao');
                const linkUnboxing = this.getAttribute('data-linkunboxing');
                const dataInicio = this.getAttribute('data-datainicio');
                const dataFim = this.getAttribute('data-datafim');
                const cliente = this.getAttribute('data-cliente');
                const tecnico = this.getAttribute('data-tecnico');
                
                // Preenche os campos do formulário com os dados da linha
                document.querySelector('input[name="id_os"]').value = idOs;
                document.querySelector('input[name="condicao"]').value = condicao;
                document.querySelector('input[name="descricao"]').value = descricao;
                document.querySelector('input[name="linkUnboxing"]').value = linkUnboxing;
                document.querySelector('input[name="dataCriacao"]').value = dataInicio;
                document.querySelector('input[name="dataFinalizacao"]').value = dataFim;
                document.querySelector('input[name="cliente"]').value = cliente;
                document.querySelector('input[name="tecnico"]').value = tecnico;

                // Altera o modo para "editar" e atualiza o botão
                document.querySelector('button[type="submit"]').textContent = 'Editar OS';
                document.querySelector('input[name="acao"]').value = 'editarConfirmado';  // Configura a ação como editar
            });
        });
    </script>
</body>

<footer></footer>

</html>
