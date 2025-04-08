<?php

class AdministradorDAO
{
    public function cadastrarAdministrador(administradormodel $administrador)
    {
        include_once "conexao.php";
        $conex = new Conexao();
        $conex->fazConexao();
        $sql = "INSERT INTO Administrador (Usuario, Senha) VALUES ( :usuario, :senha)";
        $stmt = $conex->conn->prepare($sql);
        $stmt->bindValue(':usuario', $administrador->getUsuarioAdmin());
        $stmt->bindValue(':senha', $administrador->getSenha());
        $res = $stmt->execute();
        if ($res) {
            echo "<script>alert('Cadastro Realizado com sucesso');</script>";
        } else {
            echo "<script>alert('Erro: Não foi possível realizar o cadastro');</script>";
        }
        echo "<script>location.href='../controller/processaAdministrador.php?op=Listar';</script>";
    }

    public function listarAdministradores()
    {
        include_once 'Conexao.php';
        $conex = new Conexao();
        $conex->fazConexao();
        $sql = "SELECT * FROM Administrador ORDER BY IDAdmin";
        return $conex->conn->query($sql);
    }

    public function resgataPorID($IDAdmin) {
        include_once 'Conexao.php';
        $conex = new Conexao();
        $conex->fazConexao();
        $sql = "SELECT * FROM Administrador WHERE IDAdmin='$IDAdmin'";
        return $conex->conn->query($sql);
    }

    public function alterarAdministrador(administradormodel $admin)
    {
        include_once 'Conexao.php';
        $conex = new Conexao();
        $conex->fazConexao();
        $sql = "UPDATE Administrador SET Usuario = :usuario, Senha = :senha WHERE IDAdmin = :id";
        $stmt = $conex->conn->prepare($sql);
        $stmt->bindValue(':usuario', $administrador->getUsuarioAdmin());
        $stmt->bindValue(':senha', $administrador->getSenha());
        $res = $stmt->execute();
        if ($res) {
            echo "<script>alert('Registro Alterado com sucesso');</script>";
        } else {
            echo "<script>alert('Erro: Não foi possível alterar o cadastro');</script>";
        }
        echo "<script>location.href='../controller/processaAdministrador.php?op=Listar';</script>";
    }

    public function excluirAdministrador($IDAdmin)
    {
        include_once 'Conexao.php';
        $conex = new Conexao();
        $conex->fazConexao();
        $sql = "DELETE FROM Administrador WHERE idAlu='$IDAdmin'";
        $res = $conex->conn->query($sql);
        if ($res) {
            echo "<script>alert('Exclusão realizada com sucesso!');</script>";
        } else {
            echo "<script>alert('Não foi possível excluir o usuário!');</script>";
        }
        echo "<script>location.href='../controller/processaAdministrador.php?op=Listar';</script>";
    }
}

?>