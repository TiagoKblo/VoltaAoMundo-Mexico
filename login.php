<?php
require 'classes/conexao.php'; // Arquivo de conexão com o banco de dados
require 'classes/Usuario.php'; // Inclua a classe Usuario.php

// Verifique se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomeUsuario = $_POST['nome_usuario'];
    $senha = $_POST['senha'];

    $usuario = new Usuario($conexao);
    $dadosUsuario = $usuario->autenticarUsuario($nomeUsuario, $senha);

    if ($dadosUsuario) {
        // Usuário autenticado com sucesso
        echo 'Login bem-sucedido. Bem-vindo, ' . $dadosUsuario['nome'] . '!';
        // Redirecione para a página de dashboard
        header("Location: dashboard.php");
    } else {
        echo 'Erro de login. Nome de usuário ou senha incorretos.';
    }
}
?>
