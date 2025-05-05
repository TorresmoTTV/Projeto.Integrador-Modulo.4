<?php
session_start();
require '../DAO/conexao.php';

// Lógica para determinar a ação
$acao = $_POST['acao'] ?? '';
switch ($acao) {
    case 'criar':
        criarOS();
        break;
    case 'editarConfirmado':
        confirmarEdicao();
        break;
    case 'cancelar':
        cancelarOS();
        break;
    case 'voltar':
        voltarPaginaOS();
        break;
    case 'listar':
        $ordens = listarOS();
        break;
    default:
        header("Location: ../view/gerenciar-os.php");
        exit();
}

function listarOS()
{
    global $pdo;

    // Query para buscar as ordens de serviço
    $sql = "SELECT * FROM projeto_ordemdeservico";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // Retorna todos os dados das ordens de serviço
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function criarOS()
{
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO projeto_ordemdeservico (Condicao, Descricao, LinkUnboxing, DataInicio, DataFim, fk_Cliente_IDUsuario, fk_Tecnico_IDTecnico) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $_POST['condicao'],
        $_POST['descricao'],
        $_POST['linkUnboxing'],
        $_POST['dataCriacao'],
        $_POST['dataFinalizacao'],
        $_POST['cliente'],
        $_POST['tecnico']
    ]);
    header("Location: ../view/gerenciar-os.php");
    exit();
}

function confirmarEdicao()
{
    global $pdo;
    $stmt = $pdo->prepare("UPDATE projeto_ordemdeservico SET Condicao=?, Descricao=?, LinkUnboxing=?, DataInicio=?, DataFim=?, fk_Cliente_IDUsuario=?, fk_Tecnico_IDTecnico=? WHERE IDOs=?");
    $stmt->execute([
        $_POST['condicao'],
        $_POST['descricao'],
        $_POST['linkUnboxing'],
        $_POST['dataCriacao'],
        $_POST['dataFinalizacao'],
        $_POST['cliente'],
        $_POST['tecnico'],
        $_POST['id_os']
    ]);
    unset($_SESSION['modo'], $_SESSION['os_em_edicao']);
    header("Location: ../view/gerenciar-os.php");
    exit();
}

function cancelarOS()
{
    unset($_SESSION['os_em_edicao'], $_SESSION['modo']);
    header("Location: ../view/gerenciar-os.php");
    exit();
}

function voltarPaginaOS()
{
    $tipoUsuario = $_SESSION['tipo'] ?? '';
    if ($tipoUsuario === 'admin') {
        header("Location: ../view/area-administrador.php");
    } elseif ($tipoUsuario === 'tecnico') {
        header("Location: ../view/page-tecnico.php");
    } else {
        header("Location: ../view/area-funcionario.php");
    }
    exit();
}
?>
