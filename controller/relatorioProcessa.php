<?php

require_once '../dompdf/autoload.inc.php';

use Dompdf\Dompdf;

// Conexão PDO
require '../DAO/conexao.php'; // ou ajuste o caminho conforme sua estrutura

$tipo = $_REQUEST['tipo'] ?? '';

switch ($tipo) {
    case 'clientes':
        gerarPdfClientes($pdo);
        break;
    case 'tecnicos':
        gerarPdfTecnicos($pdo);
        break;
    case 'os':
        gerarPdfOS($pdo);
        break;
    default:
        echo "Tipo de relatório inválido.";
        exit;
}

// =================== Funções ===================

function gerarPdfClientes($pdo)
{
    $stmt = $pdo->prepare("SELECT * FROM cliente ORDER BY IDUsuario DESC");
    $stmt->execute();
    $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Incluindo os estilos diretamente no HTML
    $html = getStyles() . "<h1>Relatório de Clientes</h1><div class='table-scroll-container'><table class='tabela-adm'>";
    $html .= "<thead><tr><th>ID</th><th>Nome</th><th>Email</th><th>Endereço</th><th>CPF</th><th>Telefone</th><th>Usuário</th></tr></thead><tbody>";

    foreach ($clientes as $row) {
        $html .= "<tr>
            <td>{$row['IDUsuario']}</td>
            <td>{$row['Nome']}</td>
            <td>{$row['Email']}</td>
            <td>{$row['Endereco']}</td>
            <td>{$row['CPF']}</td>
            <td>{$row['Telefone']}</td>
            <td>{$row['UsuarioCliente']}</td>
        </tr>";
    }

    $html .= "</tbody></table></div>";
    renderPdf($html, "relatorio_clientes.pdf");
}

function gerarPdfTecnicos($pdo)
{
    $stmt = $pdo->prepare("SELECT * FROM tecnico ORDER BY IDTecnico DESC");
    $stmt->execute();
    $tecnicos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Incluindo os estilos diretamente no HTML
    $html = getStyles() . "<h1>Relatório de Técnicos</h1><div class='table-scroll-container'><table class='tabela-adm'>";
    $html .= "<thead><tr><th>ID</th><th>Nome</th><th>Email</th><th>Telefone</th><th>CPF</th><th>Usuário</th></tr></thead><tbody>";

    foreach ($tecnicos as $row) {
        $html .= "<tr>
            <td>{$row['IDTecnico']}</td>
            <td>{$row['Nome']}</td>
            <td>{$row['Email']}</td>
            <td>{$row['Telefone']}</td>
            <td>{$row['CPF']}</td>
            <td>{$row['UsuarioTec']}</td>
        </tr>";
    }

    $html .= "</tbody></table></div>";
    renderPdf($html, "relatorio_tecnicos.pdf");
}

function gerarPdfOS($pdo)
{
    // Alteração para fazer o join e pegar os nomes ao invés dos IDs
    $stmt = $pdo->prepare("
        SELECT os.IDOs, os.Descricao, os.Condicao, os.DataInicio, os.DataFim,
            c.Nome AS ClienteNome, t.Nome AS TecnicoNome
        FROM projeto_ordemdeservico os
        LEFT JOIN cliente c ON os.fk_Cliente_IDUsuario = c.IDUsuario
        LEFT JOIN tecnico t ON os.fk_Tecnico_IDTecnico = t.IDTecnico
        ORDER BY os.IDOs DESC
    ");
    $stmt->execute();
    $ordens = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Incluindo os estilos diretamente no HTML
    $html = getStyles() . "<h1>Relatório de Ordens de Serviço</h1><div class='table-scroll-container'><table class='tabela-adm'>";
    $html .= "<thead><tr><th>ID</th><th>Descrição</th><th>Condição</th><th>Data Início</th><th>Data Fim</th><th>Cliente</th><th>Técnico</th></tr></thead><tbody>";

    foreach ($ordens as $row) {
        $html .= "<tr>
            <td>{$row['IDOs']}</td>
            <td>{$row['Descricao']}</td>
            <td>{$row['Condicao']}</td>
            <td>{$row['DataInicio']}</td>
            <td>{$row['DataFim']}</td>
            <td>{$row['ClienteNome']}</td>
            <td>{$row['TecnicoNome']}</td>
        </tr>";
    }

    $html .= "</tbody></table></div>";
    renderPdf($html, "relatorio_os.pdf");
}

// =================== Função comum ===================

function getStyles()
{
    return "
    <style>
        /* Container geral vertical com margem */
        .container-centralizado {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            padding: 30px;
            box-sizing: border-box;
        }

        /* Tabela */
        table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 40px;
            border-collapse: collapse;
            background-color: rgb(145, 145, 145);
            border-radius: 8px;
            overflow: hidden;
        }

        thead {
            background-color: rgb(231, 126, 51);
        }

        thead th,
        tbody td {
            padding: 12px 16px;
            font-size: 17px;
            text-align: left;
            color: #fff;
        }

        tbody tr:nth-child(even) {
            background-color:rgb(145, 145, 145);
        }

        tbody tr:hover {
            background-color:rgb(231, 126, 51);
            cursor: pointer;
        }

        h1 {
            text-align: center;
            font-size: 24px;
        }
    </style>
    ";
}

function renderPdf($html, $filename)
{
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    
    // Exibir o PDF no navegador
    $dompdf->stream($filename, ["Attachment" => false]); // false abre no navegador ao invés de forçar o download
    exit;
}

?>
