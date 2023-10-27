<?php
require 'classes/conexao.php'; // Arquivo de conexão com o banco de dados

// Conectar-se ao banco de dados
try {
    $conexao = new PDO('mysql:host=127.0.0.1;dbname=voltamundo', 'root', '');
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Excluir todas as mensagens marcadas como respondidas
    $sql = "DELETE FROM mensagens WHERE respondida = 1";
    $stmt = $conexao->prepare($sql);
    $stmt->execute();

    // Redirecione de volta para a página de dashboard após a exclusão
    header("Location: dashboard.php");
} catch (PDOException $e) {
    echo 'Erro ao excluir as mensagens respondidas: ' . $e->getMessage();
}
?>
