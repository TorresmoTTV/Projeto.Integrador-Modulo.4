<?php
require '../DAO/conexao.php';

// 1. Criar OS
function criarOS()
{
    global $pdo;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $condicao = $_POST['condicao'];
        $descricao = $_POST['descricao'];
        $link = $_POST['linkUnboxing'];
        $dataCriacao = $_POST['dataCriacao'];
        $dataFinalizacao = $_POST['dataFinalizacao'];
        $cliente = $_POST['cliente'];
        $tecnico = $_POST['tecnico'];

        $sql = "INSERT INTO projeto_ordemdeservico 
        (Condicao, Descricao, LinkUnboxing, DataInicio, DataFim, fk_Cliente_IDUsuario, fk_Tecnico_IDTecnico) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$condicao, $descricao, $link, $dataCriacao, $dataFinalizacao, $cliente, $tecnico]);

        header("Location: ../paginas/gerenciar-os.php");
        exit();
    }
}

// 2. Cancelar (limpa sessão e volta)
function cancelarOS()
{
    unset($_SESSION['os_em_edicao']);
    unset($_SESSION['modo']);
    header("Location: ../paginas/gerenciar-os.php");
    exit();
}

// 3. Editar (puxa dados da OS para preencher o formulário)
function editarOS($id)
{
    global $pdo;

    $sql = "SELECT * FROM projeto_ordemdeservico WHERE IDOs = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    if ($os = $stmt->fetch()) {
        $_SESSION['os_em_edicao'] = $os;
        header("Location: ../paginas/gerenciar-os.php");
        exit();
    } else {
        echo "OS não encontrada.";
    }
}

// 4. Preparar Edição (altera o estado do botão para "Editar")
function prepararEdicao()
{
    $_SESSION['modo'] = 'editar';
    header("Location: ../paginas/gerenciar-os.php");
    exit();
}

function confirmarEdicao()
{
    global $pdo;

    $id = $_POST['id_os'];
    $condicao = $_POST['condicao'];
    $descricao = $_POST['descricao'];
    $link = $_POST['linkUnboxing'];
    $dataCriacao = $_POST['dataCriacao'];
    $dataFinalizacao = $_POST['dataFinalizacao'];
    $cliente = $_POST['cliente'];
    $tecnico = $_POST['tecnico'];

    $sql = "UPDATE projeto_ordemdeservico SET 
            Condicao = ?, Descricao = ?, LinkUnboxing = ?, DataInicio = ?, DataFim = ?, 
            fk_Cliente_IDUsuario = ?, fk_Tecnico_IDTecnico = ? 
            WHERE IDOs = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$condicao, $descricao, $link, $dataCriacao, $dataFinalizacao, $cliente, $tecnico, $id]);

    unset($_SESSION['modo']);
    unset($_SESSION['os_em_edicao']);
    header("Location: ../paginas/gerenciar-os.php");
    exit();
}

// 5. Voltar para página anterior
function voltarPaginaOS()
{
    header("Location: area-funcionario.php");
    exit();
}

// Controle de ação
if (isset($_POST['acao'])) {
    switch ($_POST['acao']) {
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
        case 'prepararEdicao':
            prepararEdicao();
            break;
        default:
            echo "Ação não encontrada.";
    }
}
?>
