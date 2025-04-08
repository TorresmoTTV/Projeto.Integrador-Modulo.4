<?php
class ClienteDAO
{

    public function cadastrarCliente(clientemodel $cliente)
    {
        include_once 'Conexao.php';
        $conex = new Conexao();
        $conex->fazConexao();
        $sql = "INSERT INTO Cliente (Nome, Email, Endereco, CPF, Telefone, UsuarioCliente, Senha)
                VALUES (:nome, :email, :endereco, :cPF, :telefone, :usuarioCliente, :senha)";
        $stmt = $conex->conn->prepare($sql);
        $stmt->bindValue(':nome', $cliente->getNome());
        $stmt->bindValue(':matricula', $cliente->getEmail());
        $stmt->bindValue(':idade', $cliente->getEndereco());
        $stmt->bindValue(':cPF', $cliente->getCpf());
        $stmt->bindValue(':telefone', $cliente->getTelefone());
        $stmt->bindValue(':usuarioCliente', $cliente->getUsuarioCliente());
        $stmt->bindValue(':senha', $cliente->getSenha());
        $res = $stmt->execute();
        if ($res) {
            echo "<script>alert('Cadastro Realizado com sucesso');</script>";
        } else {
            echo "<script>alert('Erro: Não foi possível realizar o cadastro');</script>";
        }
        echo "<script>location.href='../controller/processaCliente.php?op=Listar';</script>";
    }

    public function listarClientes()
    {
        include_once 'Conexao.php';
        $conex = new Conexao();
        $conex->fazConexao();
        $sql = "SELECT * FROM Cliente ORDER BY IDUsuario";
        return $conex->conn->query($sql);
    }

    public function resgataPorID($idUsuario)
    {
        include_once 'Conexao.php';
        $conex = new Conexao();
        $conex->fazConexao();
        $sql = "SELECT * FROM Cliente WHERE IDUsuario='$idUsuario'";
        return $conex->conn->query($sql);
    }

    public function alterarAluno(clientemodel $cliente)
    {
        include_once 'Conexao.php';
        $conex = new Conexao();
        $conex->fazConexao();
        $sql = "UPDATE Cliente SET Nome = :nome, Email = :email, Endereco = :endereco, CPF = :cPF,
            Telefone = :telefone, UsuarioCliente = :usuariocliente, Senha = :senha WHERE IDUsuario = :id";
        $stmt = $conex->conn->prepare($sql);
        $stmt->bindValue(':id', $cliente->getIDUsuario());
        $stmt->bindValue(':nome', $cliente->getNome());
        $stmt->bindValue(':matricula', $cliente->getEmail());
        $stmt->bindValue(':idade', $cliente->getEndereco());
        $stmt->bindValue(':cPF', $cliente->getCpf());
        $stmt->bindValue(':telefone', $cliente->getTelefone());
        $stmt->bindValue(':usuarioCliente', $cliente->getUsuarioCliente());
        $stmt->bindValue(':senha', $cliente->getSenha());
        $res = $stmt->execute();
        if ($res) {
            echo "<script>alert('Registro Alterado com sucesso');</script>";
        } else {
            echo "<script>alert('Erro: Não foi possível alterar o cadastro');</script>";
        }
        echo "<script>location.href='../controller/processaCliente.php?op=Listar';</script>";
    }

    public function excluirCliente($idUsuario)
    {
        include_once 'Conexao.php';
        $conex = new Conexao();
        $conex->fazConexao();
        $sql = "DELETE FROM Cliente WHERE IDUsuario='$idUsuario'";
        $res = $conex->conn->query($sql);
        if ($res) {
            echo "<script>alert('Exclusão realizada com sucesso!');</script>";
        } else {
            echo "<script>alert('Não foi possível excluir o usuário!');</script>";
        }
        echo "<script>location.href='../controller/processaCliente.php?op=Listar';</script>";
    }
}
?>