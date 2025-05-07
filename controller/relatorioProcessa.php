<?php
require_once '../dompdf/autoload.inc.php';
use Dompdf\Dompdf;

// Conexão com o banco de dados
include '../DAO/conexao.php';

$tipo = $_GET['tipo'] ?? '';

switch ($tipo) {
    case 'clientes':
        gerarPdfClientes($conexao);
        break;
    case 'tecnicos':
        gerarPdfTecnicos($conexao);
        break;
    case 'os':
        gerarPdfOS($conexao);
        break;
    default:
        echo "Tipo de relatório inválido.";
        exit;
}

// =================== Funções ===================

function gerarPdfClientes($conexao) {
    $sql = "SELECT * FROM cliente";
    $result = mysqli_query($conexao, $sql);

    $html = "<h1>Relatório de Clientes</h1><table border='1' width='100%'>";
    $html .= "<tr><th>ID</th><th>Nome</th><th>Email</th><th>Telefone</th><th>CPF</th></tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        $html .= "<tr>
            <td>{$row['IDUsuario']}</td>
            <td>{$row['Nome']}</td>
            <td>{$row['Email']}</td>
            <td>{$row['Telefone']}</td>
            <td>{$row['CPF']}</td>
        </tr>";
    }
    $html .= "</table>";

    renderPdf($html, "relatorio_clientes.pdf");
}

function gerarPdfTecnicos($conexao) {
    $sql = "SELECT * FROM tecnico";
    $result = mysqli_query($conexao, $sql);

    $html = "<h1>Relatório de Técnicos</h1><table border='1' width='100%'>";
    $html .= "<tr><th>ID</th><th>Nome</th><th>Email</th><th>Telefone</th><th>CPF</th></tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        $html .= "<tr>
            <td>{$row['IDTecnico']}</td>
            <td>{$row['Nome']}</td>
            <td>{$row['Email']}</td>
            <td>{$row['Telefone']}</td>
            <td>{$row['CPF']}</td>
        </tr>";
    }
    $html .= "</table>";

    renderPdf($html, "relatorio_tecnicos.pdf");
}

function gerarPdfOS($conexao) {
    $sql = "SELECT * FROM projeto_ordemdeservico";
    $result = mysqli_query($conexao, $sql);

    $html = "<h1>Relatório de Ordens de Serviço</h1><table border='1' width='100%'>";
    $html .= "<tr><th>ID</th><th>Descrição</th><th>Condição</th><th>Data Início</th><th>Data Fim</th></tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        $html .= "<tr>
            <td>{$row['IDOs']}</td>
            <td>{$row['Descricao']}</td>
            <td>{$row['Condicao']}</td>
            <td>{$row['DataInicio']}</td>
            <td>{$row['DataFim']}</td>
        </tr>";
    }
    $html .= "</table>";

    renderPdf($html, "relatorio_os.pdf");
}

// Função comum de renderização
function renderPdf($html, $filename) {
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream($filename, ["Attachment" => true]);
    exit;
}
?>
