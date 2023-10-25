<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recupere os dados do formulário
    $mensagemId = $_POST['id_mensagem'];
    $resposta = $_POST['resposta'];

    // Aqui você pode adicionar a lógica para salvar a resposta no banco de dados

    // Configurações de e-mail
    $to = 'email@destinatario.com';  // Endereço de e-mail do destinatário
    $subject = 'Resposta à sua mensagem'; // Assunto do e-mail
    $message = $resposta; // Conteúdo da mensagem

    // Você pode adicionar cabeçalhos adicionais, como "From" ou "Reply-To" conforme necessário

    // Enviar o e-mail
    if (mail($to, $subject, $message)) {
        // E-mail enviado com sucesso
        echo 'Resposta enviada por e-mail com sucesso!';
    } else {
        // Erro ao enviar o e-mail
        echo 'Erro ao enviar a resposta por e-mail.';
    }

    // Redirecione de volta ao painel de mensagens
    header('Location: dashboard.php');
}
