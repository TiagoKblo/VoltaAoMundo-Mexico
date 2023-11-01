<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Kblo">
    <meta name="keywords" content="méxico">
    <meta name="description" content="Entre em contato conosco">
    <link rel="icon" href="imagens/icon.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="estilo.css">
    <title>Contato - Volta ao Mundo</title>
</head>

<body>
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

         // Mensagem enviada com sucesso
         echo '<p class="success-message">Mensagem enviada com sucesso. Entraremos em contato em breve.</p>';
         // Direcionar para a página anterior
         echo '<a href="index.html">Voltar</a>';

     } catch (PDOException $e) {
         // Erro no envio da mensagem
         echo '<p class="error-message">Erro no envio da mensagem: ' . $e->getMessage() . '</p>';
     }
}
?>
</body>
</html>
