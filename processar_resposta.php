<?php
require 'classes/conexao.php'; // Arquivo de conexão com o banco de dados

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mensagemId = $_POST['id_mensagem'];
    $resposta = $_POST['resposta'];

    try {
        // Conectar-se ao banco de dados
        $conexao = new PDO('mysql:host=127.0.0.1;dbname=voltamundo', 'root', '');
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare e execute a consulta SQL para atualizar a resposta na tabela de mensagens
        $sql = "UPDATE mensagens SET resposta = ? WHERE id = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->execute([$resposta, $mensagemId]);


        /* Configurações de e-mail
        $to = 'email@destinatario.com'; // Endereço de e-mail do destinatário
        $subject = 'Resposta à sua mensagem'; // Assunto do e-mail
        $message = $resposta; // Conteúdo da mensagem

        // Você pode adicionar cabeçalhos adicionais, como "From" ou "Reply-To" conforme necessário

        /* Enviar o e-mail
        if (mail($to, $subject, $message)) {
            // E-mail enviado com sucesso
            echo 'Resposta enviada por e-mail com sucesso!';
        } else {
            // Erro ao enviar o e-mail
            echo 'Erro ao enviar a resposta por e-mail.';
        }
*/
        // Redirecione de volta ao painel de mensagens
        header('Location: dashboard.php');
    } catch (PDOException $e) {
        // Erro na conexão ou na consulta SQL
        echo 'Erro: ' . $e->getMessage();
    }
}
