<?php
require '../DAO/conexao.php';

function listarOS() {
    global $pdo;
    $sql = "SELECT * FROM projeto_ordemdeservico ORDER BY IDOs DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function listarTecnicos() {
    global $pdo;
    $sql = "SELECT * FROM Tecnico ORDER BY IDTecnico DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function listarClientes() {
    global $pdo;
    $sql = "SELECT * FROM Cliente  ORDER BY IDUsuario DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
