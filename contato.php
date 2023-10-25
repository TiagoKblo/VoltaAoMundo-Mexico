<?php
require 'classes/conexao.php'; // Arquivo de conexão com o banco de dados

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $mensagem = $_POST['mensagem'];

    // Conectar-se ao banco de dados
    try {
        $conexao = new PDO('mysql:host=127.0.0.1;dbname=voltamundo', 'root', '');
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Inserir os dados da mensagem no banco de dados
        $sql = "INSERT INTO mensagens (nome, email, mensagem) VALUES (?, ?, ?)";
        $stmt = $conexao->prepare($sql);
        $stmt->execute([$nome, $email, $mensagem]);

        echo 'Mensagem enviada com sucesso. Entraremos em contato em breve.';
    } catch (PDOException $e) {
        echo 'Erro no envio da mensagem: ' . $e->getMessage();
    }
}
?>
