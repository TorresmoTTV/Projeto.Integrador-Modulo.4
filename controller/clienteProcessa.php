<?php
//criar conta cliente
function criarConta()
{

}
//excluir conta cliente
function excluirConta()
{

}
//alterar conta cliente
function atualizarConta()
{

}
function entrarCliente()
{
    
}

function sairCliente()
{
    session_start();
    session_unset();
    session_destroy();
    header('Location: index.php');
    exit();
}
?>