<?php
session_start(); // Inicie a sessão

require 'classes/Usuario.php';

// Verifique se o usuário está logado
if (!isset($_SESSION['usuario_autenticado'])) {
    header("Location: login.html");
    exit;
}

// Verifique o tempo de inatividade e faça o logout, se necessário
if (isset($_SESSION['ultima_atividade']) && time() - $_SESSION['ultima_atividade'] > 120) {
    // A sessão expirou, faça o logout
    session_unset();
    session_destroy();
    header("Location: login.html");
    exit;
}

// Atualize o tempo da última atividade
$_SESSION['ultima_atividade'] = time();
?>
