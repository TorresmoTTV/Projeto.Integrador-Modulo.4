<?php
function buscarPedidosPorCliente($conexao, $clienteId)
{
    $sql = "SELECT IDOs, Condicao, Descricao, DataInicio, DataFim, LinkUnboxing 
            FROM projeto_ordemdeservico 
            WHERE fk_Cliente_IDUsuario = ?";

    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $clienteId);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        while ($pedido = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($pedido['IDOs']) . "</td>";
            echo "<td>" . htmlspecialchars($pedido['Condicao']) . "</td>";
            echo "<td>" . htmlspecialchars($pedido['Descricao']) . "</td>";
            echo "<td>" . htmlspecialchars($pedido['DataInicio']) . "</td>";
            echo "<td>" . htmlspecialchars($pedido['DataFim']) . "</td>";
            echo "<td><a href='" . htmlspecialchars($pedido['LinkUnboxing']) . "' target='_blank'>Ver</a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>Nenhum pedido encontrado.</td></tr>";
    }

    $stmt->close();
}
?>