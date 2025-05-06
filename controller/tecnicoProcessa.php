<?php
require '../DAO/conexao.php';

// Lógica para determinar a ação
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao'])) {
    $acao = $_POST['acao'];
    switch ($acao) {
        case 'criar':
            criarTecnico();
            break;
        case 'editarConfirmado':
            confirmarEdicaoTecnico();
            break;
        case 'cancelar':
            cancelarTecnico();
            break;
        case 'voltar':
            voltarPaginaTecnico();
            break;
        case 'listar':
            $tecnicos = listarTecnicos();
            break;
        default:
            header("Location: ../view/criar-tecnico.php");
            exit();
    }
}

function listarTecnicos()
{
    global $pdo;

    // Query para buscar os técnicos
    $sql = "SELECT * FROM tecnico";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // Retorna todos os dados dos técnicos
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function criarTecnico()
{
    global $pdo;
    // Encriptar a senha antes de salvar no banco
    $senhaHash = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO tecnico (Nome, Email, CPF, Telefone, UsuarioTec, Senha) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $_POST['nome'],
        $_POST['email'],
        $_POST['cpf'],
        $_POST['telefone'],
        $_POST['usuario'],
        $senhaHash // Usando a senha criptografada
    ]);
    header("Location: ../view/criar-tecnico.php");
    exit();
}

function confirmarEdicaoTecnico()
{
    global $pdo;
    // Se a senha foi alterada, encripte-a
    $senhaHash = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("UPDATE tecnico SET Nome=?, Email=?, CPF=?, Telefone=?, UsuarioTec=?, Senha=? WHERE IDTecnico=?");
    $stmt->execute([
        $_POST['nome'],
        $_POST['email'],
        $_POST['cpf'],
        $_POST['telefone'],
        $_POST['usuario'],
        $senhaHash, // Usando a senha criptografada
        $_POST['id_tecnico']
    ]);
    unset($_SESSION['modo'], $_SESSION['tecnico_em_edicao']);
    header("Location: ../view/criar-tecnico.php");
    exit();
}

function cancelarTecnico()
{
    unset($_SESSION['tecnico_em_edicao'], $_SESSION['modo']);
    header("Location: ../view/criar-tecnico.php");
    exit();
}

function voltarPaginaTecnico()
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

function gerarTabelaOrdensServico()
{
    require '../DAO/conexao.php';

    $stmt = $pdo->query("
        SELECT
            p.IDOs,
            p.Condicao,
            p.Descricao,
            p.DataInicio,
            p.DataFim,
            p.LinkUnboxing,
            c.Nome AS NomeCliente,
            t.Nome AS NomeTecnico
        FROM projeto_ordemdeservico p
        LEFT JOIN cliente c ON p.fk_Cliente_IDUsuario = c.IDUsuario
        LEFT JOIN tecnico t ON p.fk_Tecnico_IDTecnico = t.IDTecnico
        ORDER BY p.IDOs DESC
    ");

    $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($dados)) {
        return "<p style='text-align:center;'>Nenhuma ordem de serviço encontrada.</p>";
    }

    $html = '<table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>Número</th>
                <th>Condição</th>
                <th>Descrição</th>
                <th>Data de Criação</th>
                <th>Data de Finalização</th>
                <th>Link Unboxing</th>
                <th>Cliente</th>
                <th>Técnico</th>
            </tr>
        </thead>
        <tbody>';

    foreach ($dados as $os) {
        $html .= '<tr>
            <td>' . htmlspecialchars($os['IDOs']) . '</td>
            <td>' . htmlspecialchars($os['Condicao']) . '</td>
            <td>' . htmlspecialchars($os['Descricao']) . '</td>
            <td>' . htmlspecialchars($os['DataInicio']) . '</td>
            <td>' . htmlspecialchars($os['DataFim']) . '</td>
            <td><a href="' . htmlspecialchars($os['LinkUnboxing']) . '" target="_blank">Ver Vídeo</a></td>
            <td>' . htmlspecialchars($os['NomeCliente']) . '</td>
            <td>' . htmlspecialchars($os['NomeTecnico']) . '</td>
        </tr>';
    }

    $html .= '</tbody></table>';

    return $html;
}

?>