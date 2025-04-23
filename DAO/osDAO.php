<?php

class osDAO
{

    public function cadastrarOS(osmodel $OS)
    {
        include_once 'conexaoDAO.php';
        $conex = new Conexao();
        $conex->fazConexao();
        $sql = "INSERT INTO Projeto (Condicao, Descricao, LinkUnboxing, DataInicio, DataFim, fk_Tecnico_IDTecnico, fk_Cliente_IDUsuario)
                VALUES (:condicao, :descricao, :linkunboxing, :datainicio, :datafim, :fk_tecnico_idtecnico, :fk_cliente_idusuario)";
        $stmt = $conex->conn->prepare($sql);
        $stmt->bindValue(":condicao", $OS->getCondicao());
        $stmt->bindValue(":descricao", $OS->getDescricao());
        $stmt->bindValue(":linkunboxing", $OS->getLinkUnboxing());
        $stmt->bindValue(":datainicio",$OS->getDataInicio());
        $stmt->bindValue(":datafim", $OS->getDataFim());
        $stmt->bindValue(":fk_tecnico_idtecnico", $OS->getFkTecnicoIDTecnico());
        $stmt->bindValue("fk_cliente_idusuario", $OS->getFkClienteIDUsuario());
        $res = $stmt->execute();
        if ($res) {
            echo "<script>alert('Cadastro Realizado com sucesso');</script>";
        } else {
            echo "<script>alert('Erro: Não foi possível realizar o cadastro');</script>";
        }
        echo "<script>location.href='../controller/processaProjeto.php?op=Listar';</script>";
    }

    public function listarOS()
    {
        include_once 'conexaoDAO.php';
        $conex = new Conexao();
        $conex->fazConexao();
        $sql = "SELECT * FROM Projeto ORDER BY IDOs";
        return $conex->conn->query($sql);
    }

    public function resgataPorID($idOS)
    {
        include_once 'conexaoDAO.php';
        $conex = new Conexao();
        $conex->fazConexao();
        $sql = "SELECT * FROM Projeto WHERE IDOs='$idOS'";
        return $conex->conn->query($sql);
    }

    public function alterarOS(osmodel $OS)
    {
        include_once 'conexaoDAO.php';
        $conex = new Conexao();
        $conex->fazConexao();
        $sql = "UPDATE Projeto SET Condicao = :condicao, Descricao = :descricao, LinkUnboxing = :linkunboxing,
            DataInicio = :datainicio, DataFim = :datafim, fk_Tecnico_IDTecnico = :fk_tecnico_idtecnico, fk_Cliente_IDUsuario = :fk_cliente_idusuario WHERE IDOs = :id";
        $stmt = $conex->conn->prepare($sql);
        $stmt->bindValue(':id', $OS->getIDOs());
        $stmt->bindValue(":condicao", $OS->getCondicao());
        $stmt->bindValue(":descricao", $OS->getDescricao());
        $stmt->bindValue(":linkunboxing", $OS->getLinkUnboxing());
        $stmt->bindValue(":datainicio",$OS->getDataInicio());
        $stmt->bindValue(":datafim", $OS->getDataFim());
        $stmt->bindValue(":fk_tecnico_idtecnico", $OS->getFkTecnicoIDTecnico());
        $stmt->bindValue("fk_cliente_idusuario", $OS->getFkClienteIDUsuario());
        $res = $stmt->execute();
        if ($res) {
            echo "<script>alert('Registro Alterado com sucesso');</script>";
        } else {
            echo "<script>alert('Erro: Não foi possível alterar o cadastro');</script>";
        }
        echo "<script>location.href='../controller/processaProjeto.php?op=Listar';</script>";
    }

    public function excluirOS($idOS)
    {
        include_once 'conexaoDAO.php';
        $conex = new Conexao();
        $conex->fazConexao();
        $sql = "DELETE FROM Projeto WHERE IDOs ='$idOS'";
        $res = $conex->conn->query($sql);
        if ($res) {
            echo "<script>alert('Exclusão realizada com sucesso!');</script>";
        } else {
            echo "<script>alert('Não foi possível excluir o usuário!');</script>";
        }
        echo "<script>location.href='../controller/processaProjeto.php?op=Listar';</script>";
    }
}
?>