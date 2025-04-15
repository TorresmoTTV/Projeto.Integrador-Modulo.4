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
    <title>Gerenciar Ordens de Serviço</title>
</head>

<body>
    <header>
        <h2>
            <img src="../img/logo.png" alt="Logo Empresa" id="logo-empresa">
        </h2>
        <h2>
            <p id="h2-right">Gerenciar</p>
            <p id="h2-right">Ordens de Serviço</p>
        </h2>
    </header>
    <form action="gerenciar-os.php" method="POST">
        <div class="form-container">
            <div class="form-column">
                <div class="form-group">
                    <label>Condição</label>
                    <input type="text" name="condição" required maxlength="50">
                </div>
                <div class="form-group">
                    <label>Descrição</label>
                    <input type="text" name="descrição" required maxlength="50">
                </div>
                <div class="form-group">
                    <label>Link Unboxing</label>
                    <input type="text" name="link unboxing" required maxlength="14">
                </div>
                <div class="form-group">
                    <label>Data de Criação</label>
                    <input type="tel" name="telefone" required maxlength="15">
                </div>
                <div class="form-group">
                    <label>Data de Finalização</label>
                    <input type="text" name="usuario" required maxlength="30">
                </div>
                <div class="form-group">
                    <label>Cliente</label>
                    <input type="password" name="senha" required maxlength="20">
                </div>
                <div class="form-group">
                    <label>Técnico</label>
                    <input type="password" name="senha" required maxlength="20">
                </div>
            </div>
            <div>
                <table>
                    <thead>
                        <tr>
                            <td>
                                Id
                            </td>
                            <td>
                                Condição
                            </td>
                            <td>
                                Descrição
                            </td>
                            <td>
                                Link Unboxing
                            </td>
                            <td>
                                Data de Criação
                            </td>
                            <td>
                                Data de Finalização
                            </td>
                            <td>
                                Cliente
                            </td>
                            <td>
                                Técnico
                            </td>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="button-container">
            <button type="submit" onclick="criarOS()">Criar</button>
            <button type="submit" onclick="editarOS()">Editar Ordem</button>
            <button type="submit" onclick="cancelarOS()">Cancelar</button>
        </div>
    </form>
    <div id="div-center"><button type="submit" onclick="voltarPaginaOS()">Voltar para Página Anterior</button></div>
</body>

<footer>
</footer>

</html>