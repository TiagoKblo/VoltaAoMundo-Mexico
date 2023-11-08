<?php
require 'verificar_autenticacao.php';
$usuario = new Usuario($conexao);
$mensagens = $usuario->buscarMensagens();

include 'contador_mensagens.php';
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
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Alterna navegação">
                <span class="navbar-toggler-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-filter-square-fill" viewBox="0 0 16 16">
                        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm.5 5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1 0-1zM4 8.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm2 3a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5z" />
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
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Sair</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
    <main class="painel-mensagens">
        <div class="container">
            <h2 class="text-center mt-4">Caixa de Mensagens</h2>
            <div class="mt-4" id="mensagens-container">
                <p>Bem-vindo, <?php echo isset($_SESSION['nome_usuario']) ? $_SESSION['nome_usuario'] : 'Usuário Desconhecido'; ?>! Voce possui: <?php echo $mensagensTotal; ?> Mensagens!</p>

                <?php
                // Loop através das mensagens
                foreach ($mensagens as $mensagem) {
                    $respondidaClass = ($mensagem['respondida'] == 1) ? 'respondida' : '';
                ?>
                    <div class="mensagem <?php echo $respondidaClass; ?>">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Remetente: <?= $mensagem['nome'] ?></h4>
                                <h5>E-mail: <?= $mensagem['email'] ?></h5>
                                <h5>Data: <?= $mensagem['data_envio'] ?></h5>
                                <h4>Mensagem:</h4>

                                <div class="mensagem-container">
                                    <h5><?= $mensagem['mensagem'] ?></h5>
                                </div>
                            </div>

                        </div>

                        <form method="POST" action="processar_resposta.php">
                            <input type="hidden" name="id_mensagem" value="<?= $mensagem['id'] ?>">
                            <input type="hidden" name="email_destinatario" value="<?= $mensagem['email'] ?>">
                            <div class="form-group">
                                <?php
                                if ($mensagem['respondida'] == 1) {
                                    $readonly = 'readonly';
                                } else {
                                    $readonly = '';
                                }
                                ?>

                                <textarea name="resposta" rows="3" class="form-control" placeholder="Sua resposta" <?= $readonly ?>>
<?php echo $mensagem['resposta']; ?>
</textarea>





                            </div>


                            <button type="submit" class="btn btn-primary btn-block">Responder</button>
                        </form>

                        <!-- Botão para marcar como respondida -->
                        <?php if ($mensagem['respondida'] == 1) { ?>
                            <button class="btn btn-secondary respondida btn-block">Respondida</button>
                        <?php } else { ?>
                            <a href="marcar_respondida.php?id=<?= $mensagem['id'] ?>" class="btn btn-success btn-block">Marcar como Respondida</a>
                            <!-- Botão para excluir mensagem -->
                            <a href="excluir_mensagem.php?id=<?= $mensagem['id'] ?>" class="btn btn-danger btn-block">Excluir</a>
                        <?php } ?>
                    </div>
                <?php
                }
                ?>

            </div>
            <h4> Respondidas: <?php echo $mensagensRespondidas; ?> Não Respondidas: <?php echo $mensagensNaoRespondidas; ?></h4>
            <a href="excluir_mensagens_respondidas.php" class="btn btn-3d">Excluir Mensagens Respondidas</a>

        </div>





    </main>

    <footer class="text-center">
        <div class="container">
            <p><strong>Projeto Volta ao Mundo - México</strong></p>
            <a href="https://github.com/TiagoKblo"><em>Desenvolvido por Kblo</em></a>
            <br>

        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
