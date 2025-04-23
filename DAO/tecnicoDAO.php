<?php

class TecnicoDAO
{
    public function cadastrarTecnico(tecnicomodel $tecnico)
    {
        include_once 'conexaoDAO.php';
        $conex = new conexao();
        $conex->fazConexao();
        $sql = "INSERT INTO Tecnico (Nome, Telefone, Email, CPF, UsuarioTec, Senha)
                    VALUES ( :nome, :telefone, :email, :cpf, :usuarioTec, :senha)";
        $stmt = $conex->conn->prepare($sql);
        $stmt->bindValue(':nome', $tecnico->getNome());
        $stmt->bindValue(':telefone', $tecnico->getTelefone());
        $stmt->bindValue(':email', $tecnico->getEmail());
        $stmt->bindValue(':cpf', $tecnico->getCPF());
        $stmt->bindValue(':usuarioTec', $tecnico->getUsuarioTec());
        $stmt->bindValue(':senha', $tecnico->getSenha());
        $res = $stmt->execute();
        if ($res) {
            echo "<script>alert('Cadastro Realizado com sucesso');</script>";
        } else {
            echo "<script>alert('Erro: Não foi possível realizar o cadastro');</script>";
        }
        echo "<script>location.href='../controller/processaTecnico.php?op=Listar';</script>";
    }

    public function listarTecnicos() {
        include_once 'conexaoDAO.php';
        $conex = new Conexao();
        $conex->fazConexao();
        $sql = "SELECT * FROM Tecnico ORDER BY IDTecnico";
        return $conex->conn->query($sql);
    }

    public function resgataPorID($idTecnico) {
        include_once 'conexaoDAO.php';
        $conex = new Conexao();
        $conex->fazConexao();
        $sql = "SELECT * FROM aluno WHERE IDTecnico='$idTecnico'";
        return $conex->conn->query($sql);
    }

    public function alterarTecnico($idTecnico, $nome, $telefone, $email, $cpf, $usuarioTec, $senha) {
        include_once 'conexaoDAO.php';
        $conex = new Conexao();
        $conex->fazConexao();
        $sql = "UPDATE Tecnico SET Nome = :nome, Telefone = :telefone, Email = :email, CPF = :cPF, UsuarioTec = :usuarioTec, Senha = :senha where IDTecnico = :iDTecnico";
        $stmt = $conex->conn->prepare($sql);
        $stmt->bindValue(':iDTecnico', $tecnico->getIDTecnico());
        $stmt->bindValue(':nome', $tecnico->getNome());
        $stmt->bindValue(':telefone', $tecnico->getTelefone());
        $stmt->bindValue(':email', $tecnico->getEmail());
        $stmt->bindValue(':cPF', $tecnico->getCPF());
        $stmt->bindValue(':usuarioTec', $tecnico->getUsuarioTec());
        $stmt->bindValue(':senha', $tecnico->getSenha());
        $res = $stmt->execute();
        if ($res) {
            echo "<script>alert('Registro Alterado com sucesso');</script>";
        } else {
            echo "<script>alert('Erro: Não foi possível alterar o cadastro');</script>";
        }
        echo "<script>location.href='../controller/processaTecnico.php?op=Listar';</script>";
    }

    public function excluirTecnico($idTecnico) {
        include_once 'conexaoDAO.php';
        $conex = new Conexao();
        $conex->fazConexao();
        $sql = "DELETE FROM Tecnico WHERE IDTecnico ='$idTecnico'";
        $res = $conex->conn->query($sql);
        if ($res) {
            echo "<script>alert('Exclusão realizada com sucesso!');</script>";
        } else {
            echo "<script>alert('Não foi possível excluir o usuário!');</script>";
        }
        echo "<script>location.href='../controller/processaTecnico.php?op=Listar';</script>";
    }

    public function buscarTecnicoPorLoginSenha($login, $senha)
    {
        include_once 'conexaoDAO.php';
        include_once '../model/tecnicomodel.php';
        
        $conex = new Conexao();
        $conex->fazConexao();
        $tecnico = null;

        $sql = "SELECT * FROM Tecnico WHERE UsuarioTec = ? AND Senha = ?";
        $stmt = $conex->conn->prepare($sql);
        $stmt->bindValue(1, $login);
        $stmt->bindValue(2, $senha);
        $stmt->execute();

        if ($row = $stmt->fetch()) {
            $tecnico = new TecnicoModel();
            $tecnico->setIDTecnico($row['IDTecnico']);
            $tecnico->setNome($row['Nome']);
            echo "<script>console.log('Técnico encontrado: " . $row['Nome'] . "');</script>";
        } else {
            echo "<script>console.log('Técnico não encontrado.');</script>";
        }
        return $tecnico;
    }
}

?>