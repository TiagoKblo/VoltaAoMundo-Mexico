<?php
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $mensagemId = $_GET['id'];

    // Conecte-se ao banco de dados (você pode usar seu arquivo de conexão existente)
    require 'classes/conexao.php';

    // Atualize o banco de dados para marcar a mensagem como respondida
    $sql = "UPDATE mensagens SET respondida = 1 WHERE id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$mensagemId]);

    // Redirecione de volta à página dashboard após a atualização
    header("Location: dashboard.php");
} else {
    // Lidere com o caso em que o parâmetro de ID está ausente ou vazio
    echo "ID da mensagem ausente ou inválido.";
}
?>
