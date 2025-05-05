<?php
//criar conta cliente
function criarConta()
{
    require '../DAO/conexao.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $endereco = $_POST['endereco'];
        $cpf = $_POST['cpf'];
        $telefone = $_POST['telefone'];
        $username = $_POST['usuario'];
        $password = $_POST['senha'];

        $stmt = $pdo->prepare("SELECT * FROM cliente WHERE UsuarioCliente = ?");
        $stmt->execute([$username]);
        if ($stmt->fetch()) {
            $error = 'Nome do usuário já existe.';
        } else {
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $pdo->prepare('INSERT INTO cliente (Nome, Email, Endereco, CPF, Telefone, UsuarioCliente, Senha) VALUES (?, ?, ?, ?, ?, ?, ?)');
            if ($stmt->execute([$nome, $email, $endereco, $cpf, $telefone, $username, $hashed_password])) {
                $sucess = 'Usuário registrado com sucesso. Você pode fazer login agora.';
                header('Location: ../view/page-cliente.php');
            } else {
                $error = "Erro ao registrar usuário. Tente novamente.";
            }
        }
    }
}
//excluir conta cliente
function excluirConta()
{
    require '../DAO/conexao.php';

    // Verifica se o usuário está logado
    if (!isset($_SESSION['user_id'])) {
        header('Location: ../view/page-cliente.php');
        exit();
    }

    $idUsuario = $_SESSION['user_id'];

    // Exclui o usuário da tabela cliente
    $stmt = $pdo->prepare("DELETE FROM cliente WHERE IDUsuario = ?");
    if ($stmt->execute([$idUsuario])) {
        // Encerra a sessão e redireciona
        session_unset();
        session_destroy();
        header('Location: ../view/area-cliente.php');
        exit();
    } else {
        echo "<script>alert('Erro ao excluir a conta. Tente novamente.');</script>";
    }
}

//alterar conta cliente
function atualizarConta()
{
    require '../DAO/conexao.php';

    if (!isset($_SESSION['user_id'])) {
        header('Location: ../view/page-cliente.php');
        exit();
    }

    $idUsuario = $_SESSION['user_id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $endereco = $_POST['endereco'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    // Verifica se o nome de usuário já existe para outro usuário
    $stmt = $pdo->prepare("SELECT IDUsuario FROM cliente WHERE UsuarioCliente = ? AND IDUsuario != ?");
    $stmt->execute([$usuario, $idUsuario]);
    if ($stmt->fetch()) {
        echo "<script>alert('Nome de usuário já está em uso por outro cliente.'); window.location.href='editar-cliente.php';</script>";
        exit();
    }

    // Atualiza com ou sem alteração de senha
    if (!empty($senha)) {
        $senhaHash = password_hash($senha, PASSWORD_BCRYPT);
        $sql = "UPDATE cliente SET Nome = ?, Email = ?, Endereco = ?, CPF = ?, Telefone = ?, UsuarioCliente = ?, Senha = ? WHERE IDUsuario = ?";
        $params = [$nome, $email, $endereco, $cpf, $telefone, $usuario, $senhaHash, $idUsuario];
    } else {
        $sql = "UPDATE cliente SET Nome = ?, Email = ?, Endereco = ?, CPF = ?, Telefone = ?, UsuarioCliente = ? WHERE IDUsuario = ?";
        $params = [$nome, $email, $endereco, $cpf, $telefone, $usuario, $idUsuario];
    }

    $stmt = $pdo->prepare($sql);
    if ($stmt->execute($params)) {
        echo "<script>alert('Conta atualizada com sucesso.'); window.location.href='page-cliente.php';</script>";
    } else {
        echo "<script>alert('Erro ao atualizar conta.');</script>";
    }
}


function entrarCliente()
{
    require '../DAO/conexao.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $stmt = $pdo->prepare("SELECT * FROM cliente WHERE UsuarioCliente = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['Senha'])) {
            $_SESSION['user_id'] = $user['IDUsuario'];
            $_SESSION['username'] = $user['UsuarioCliente'];
            header('Location: page-cliente.php');
            exit();
        } else {
            $error = 'Nome de usuário ou senha inválidos';
        }
    }
}

function buscarClientePorId($pdo, $idUsuario)
{
    require '../DAO/conexao.php';

    $stmt = $pdo->prepare("SELECT * FROM cliente WHERE IDUsuario = ?");
    $stmt->execute([$idUsuario]);
    return $stmt->fetch();
}

function buscarPedidosPorCliente($pdo, $clienteId)
{
    $sql = "SELECT IDOs, Condicao, Descricao, DataInicio, DataFim, LinkUnboxing
            FROM projeto_ordemdeservico
            WHERE fk_Cliente_IDUsuario = ?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$clienteId]);
    $pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($pedidos) {
        foreach ($pedidos as $pedido) {
            $dataInicio = $pedido['DataInicio'] ? date('d/m/Y H:i', strtotime($pedido['DataInicio'])) : '---';

            echo "<div class='card-pedido'>";
            echo "<div class='cabecalho'>";
            echo "<strong>Número:</strong> #{$pedido['IDOs']}<br>";
            echo "<strong>Status:</strong> {$pedido['Condicao']}<br>";
            echo "<strong>Início:</strong> {$dataInicio}<br>";

            // Exibe DataFim somente se for válida
            if (!empty($pedido['DataFim']) && $pedido['DataFim'] !== '0000-00-00' && $pedido['DataFim'] !== '0000-00-00 00:00:00') {
                $timestampFim = strtotime($pedido['DataFim']);
                if ($timestampFim && $timestampFim > 0) {
                    $dataFim = date('d/m/Y H:i', $timestampFim);
                    echo "<strong>Fim:</strong> {$dataFim}<br>";
                }
            }


            echo "</div>";

            echo "<div class='descricao'>";
            echo "<strong>Descrição:</strong> " . htmlspecialchars($pedido['Descricao']) . "<br>";

            // Verificar se o link é do YouTube
            if (!empty($pedido['LinkUnboxing']) && filter_var($pedido['LinkUnboxing'], FILTER_VALIDATE_URL)) {
                $url = $pedido['LinkUnboxing'];
                if (strpos($url, 'youtube.com') !== false || strpos($url, 'youtu.be') !== false) {
                    echo "<strong>Unboxing:</strong> <a href='{$url}' target='_blank'>Ver vídeo</a><br>";
                } else {
                    echo "<strong>Unboxing:</strong> Link inválido para YouTube.<br>";
                }
            }
            echo "</div>";

            echo "<div class='linha-status'>";
            echo gerarLinhaStatus($pedido['Condicao'], $pedido['DataInicio'], $pedido['DataFim']);
            echo "</div>";

            echo "</div>";
        }
    } else {
        echo "<p>Nenhum pedido encontrado.</p>";
    }
}

function gerarLinhaStatus($condicao, $dataInicio, $dataFim)
{
    $etapas = [
        'Início' => $dataInicio,
        'Finalização' => $dataFim
    ];

    $saida = "";
    foreach ($etapas as $nome => $data) {
        $ativa = (
            strtolower($condicao) === strtolower($nome) ||
            strtolower($condicao) === 'concluído' ||
            strtolower($condicao) === 'produto entregue'
        );
        $classe = $ativa ? 'etapa ativa' : 'etapa';

        $saida .= "<div class='$classe'><div class='ponto'></div><span>$nome</span>";

        if (!empty($data) && $data !== '0000-00-00' && $data !== '0000-00-00 00:00:00') {
            $timestamp = strtotime($data);
            if ($timestamp && $timestamp > 0) {
                $saida .= "<div class='data-etapa'>" . date('d/m/Y', $timestamp) . "</div>";
            }
        }

        $saida .= "</div>";
    }
    return $saida;
}




function sairCliente()
{
    session_start();
    session_unset();
    session_destroy();
    header('Location: ../view/area-cliente.php');
    exit();
}
?>