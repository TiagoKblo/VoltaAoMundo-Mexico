<?php
require 'classes/Usuario.php';
$usuario = new Usuario($conexao);

// Verifique se o usuário está logado

$mensagens = $usuario->buscarMensagens();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Kblo">
    <meta name="keywords" content="méxico">
    <meta name="description" content="Cadastro - Volta ao Mundo">
    <link rel="icon" href="imagens/icon.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="estilo.css">
    <title> Mensagens de Contato - Volta ao Mundo</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg" style="background-color: #C8102E;">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Alterna navegação">
                <span class="navbar-toggler-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor"
                        class="bi bi-filter-square-fill" viewBox="0 0 16 16">
                        <path
                            d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm.5 5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1 0-1zM4 8.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm2 3a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5z" />
                    </svg>
                </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">Página Inicial</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="historia.html">História</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cultura.html">Cultura</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="gastronomia.html">Gastronomia</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pontos-turisticos.html">Pontos Turísticos</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="contato.html">Contato</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="login.html">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="painel-mensagens bg-light">
    <div class="container">
        <h2 class="text-center mt-4">Mensagens de Contato</h2>
        <div class="mt-4" id="mensagens-container">
        <main class="painel-mensagens bg-light">
            <?php
            // Loop através das mensagens
            foreach ($mensagens as $mensagem) {
                $respondidaClass = ($mensagem['respondida'] == 1) ? 'respondida' : '';
            ?>
            <div class="mensagem <?php echo $respondidaClass; ?>">
                <div class="row">
                    <div class="col-md-6">
                        <h4>Remetente: <?= $mensagem['nome'] ?></h4>
                        <h5>E-mail: <?= $mensagem['email'] ?></h5>
                        <p>Data: <?= $mensagem['data_envio'] ?></p>
                    </div>
                    <div class="col-md-6">
                        <p>Mensagem: <?= $mensagem['mensagem'] ?></p>
                    </div>
                </div>

                <form method="POST" action="processar_resposta.php">
                    <input type="hidden" name="id_mensagem" value="<?= $mensagem['id'] ?>">
                    <input type="hidden" name="email_destinatario" value="<?= $mensagem['email'] ?>">
                    <div class="form-group">
                        <textarea name="resposta" rows="3" class="form-control" placeholder="Sua resposta"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Responder</button>
                </form>

                <!-- Botão para marcar como respondida -->
                <?php if ($mensagem['respondida'] == 1) { ?>
                    <button class="btn btn-secondary respondida">Respondida</button>
                <?php } else { ?>
                    <a href="marcar_respondida.php?id=<?= $mensagem['id'] ?>" class="btn btn-success">Marcar como Respondida</a>
                <?php } ?>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</main>

    <footer class="text-center">
        <div class="container">
            <p><strong>Projeto Volta ao Mundo - México</strong></p>
            <a href="https://github.com/TiagoKblo"><em>Desenvolvido por Kblo</em></a>
            <br>
            <audio controls loop>
                <source src="musica/Latino_Party_-_Sekosh_(2).mp3" type="audio/mp3">
                Seu navegador não suporta a tag de áudio.
            </audio>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
