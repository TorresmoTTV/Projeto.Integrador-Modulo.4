<?php

function criarContaTec()
{

}

function editarContaTec()
{

}

function cancelarContaTec()
{

}

function voltarViewTec()
{

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