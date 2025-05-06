<?php
require '../DAO/conexao.php';

function listarOS() {
    global $pdo;
    $sql = "SELECT * FROM projeto_ordemdeservico";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function listarTecnicos() {
    global $pdo;
    $sql = "SELECT * FROM Tecnico";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function listarClientes() {
    global $pdo;
    $sql = "SELECT * FROM Cliente";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
