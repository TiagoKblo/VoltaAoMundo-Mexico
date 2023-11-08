<?php

// Inicialize as variáveis de contador
$mensagensRespondidas = 0;
$mensagensNaoRespondidas = 0;

// Loop através das mensagens e atualize os contadores
foreach ($mensagens as $mensagem) {
    if ($mensagem['respondida'] == 1) {
        $mensagensRespondidas++;
    } else {
        $mensagensNaoRespondidas++;
    }
}
// Inicialize a variável de contador para a soma total de mensagens
$mensagensTotal = count($mensagens);
?>
