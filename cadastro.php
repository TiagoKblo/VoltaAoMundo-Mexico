<?php
require 'classes/conexao.php'; // Arquivo de conexão com o banco de dados

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomeUsuario = $_POST['nome_usuario'];
    $senha = $_POST['senha'];

    // Hash da senha
    $hashSenha = password_hash($senha, PASSWORD_DEFAULT);

    // Conectar-se ao banco de dados
    try {
        $conexao = new PDO('mysql:host=127.0.0.1;dbname=voltamundo', 'root', '');
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Inserir os dados do usuário no banco de dados
        $sql = "INSERT INTO usuarios (nome, senha) VALUES (?, ?)";
        $stmt = $conexao->prepare($sql);
        $stmt->execute([$nomeUsuario, $hashSenha]);

        echo 'Cadastro realizado com sucesso. Você pode fazer login agora.';
    // Utilizando JavaScript para redirecionar após 5 segundos
    echo '<script>
        setTimeout(function() {
            window.location.href = "login.html";
        }, 5000); // 5000 milissegundos = 5 segundos
    </script>';
    } catch (PDOException $e) {
        echo 'Erro de cadastro: ' . $e->getMessage();
    }
}
