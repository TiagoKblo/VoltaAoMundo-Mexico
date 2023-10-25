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
        //Direcionar para a página de login
        header("Location: login.html");
    
    } catch (PDOException $e) {
        echo 'Erro de cadastro: ' . $e->getMessage();
    }
}
?>
