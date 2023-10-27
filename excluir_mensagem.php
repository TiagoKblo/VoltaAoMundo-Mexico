<?php
require 'classes/conexao.php'; // Arquivo de conexão com o banco de dados

// Verifique se o ID da mensagem foi fornecido na URL
if (isset($_GET['id'])) {
    $idMensagem = $_GET['id'];

    // Conectar-se ao banco de dados
    try {
        $conexao = new PDO('mysql:host=127.0.0.1;dbname=voltamundo', 'root', '');
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Excluir a mensagem com base no ID fornecido
        $sql = "DELETE FROM mensagens WHERE id = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->execute([$idMensagem]);

        // Redirecione de volta para a página de dashboard após a exclusão
        header("Location: dashboard.php");
    } catch (PDOException $e) {
        echo 'Erro ao excluir a mensagem: ' . $e->getMessage();
    }
} else {
    // Caso o ID da mensagem não tenha sido fornecido na URL, você pode lidar com isso apropriadamente
    echo 'ID da mensagem não fornecido.';
}
?>
