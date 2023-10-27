<?php
require 'classes/conexao.php'; // Arquivo de conexão com o banco de dados
require 'classes/Usuario.php'; // Inclua a classe Usuario.php

// Inicie a sessão
session_start();

// Verifique se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomeUsuario = $_POST['nome_usuario'];
    $senha = $_POST['senha'];

    $usuario = new Usuario($conexao);
    $dadosUsuario = $usuario->autenticarUsuario($nomeUsuario, $senha);

    if ($dadosUsuario) {
        // Usuário autenticado com sucesso
        echo 'Login bem-sucedido. Bem-vindo, ' . $dadosUsuario['nome'] . '!';

        // Defina a variável de sessão 'usuario_autenticado' como verdadeira
        $_SESSION['usuario_autenticado'] = true;

        // Defina a variável de sessão 'nome_usuario' como o nome do usuário
        $_SESSION['nome_usuario'] = $dadosUsuario['nome'];

        // Defina o tempo da última atividade
        $_SESSION['ultima_atividade'] = time();

        // Redirecione para a página de dashboard
        header("Location: dashboard.php");
    } else {
        echo 'Erro de login. Nome de usuário ou senha incorretos.';
        echo '<a href="login.html" class="btn btn-primary">Voltar para o Login</a>';
    }
}
?>


