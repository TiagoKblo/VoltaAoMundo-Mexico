<?php
// Arquivo de conexão com o banco de dados (conexao.php)
require 'conexao.php';

// Consulta SQL para obter as mensagens
$sql = "SELECT * FROM mensagens";
$resultado = $conexao->query($sql);

// Verifique se existem mensagens
if ($resultado->rowCount() > 0) {
    while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
        // Exiba as mensagens
        echo '<div class="mensagem">';
        echo '<h3>' . $row['nome'] . '</h3>';
        echo '<p>' . $row['email'] . '</p>';
        echo '<p>' . $row['mensagem'] . '</p>';
        echo '</div>';
    }
} else {
    echo 'Nenhuma mensagem encontrada.';
}
?>
