<?php 
     $perguntas = [
        '1' => 'Quanto é 9 × 8?',
        '2' => 'Quanto é 90 ÷ 8?',
        '3' => 'Qual é a raiz quadrada de 8?',
        '4' => 'Quanto é 5% de 100?',
        '5' => 'Quanto é 15 + 27?',
        '6' => 'Quanto é 7²?',
        '7' => 'Quanto é 1/3 de 60?',
        '8' => 'Quanto é 3 × 4 + 5?',
        '9' => 'Quanto é 100 - 57?',
        '10' => 'Quanto é 12 × 11?',
        '11' => 'Quanto é 144 ÷ 12?',
        '12' => 'Qual é o dobro de 35?',
        '13' => 'Quanto é 25% de 200?',
        '14' => 'Quanto é 8 × 7 - 6?',
        '15' => 'Quanto é a metade de 86?'
    ];

    $respostas = [
        '1' => ['72', '80', '75', '98'],
        '2' => ['11.25', '12', '10.5', '9.8'],
        '3' => ['2.828', '2.5', '3', '1.5'],
        '4' => ['5', '2', '10', '7'],
        '5' => ['42', '32', '52', '37'],
        '6' => ['49', '14', '64', '21'],
        '7' => ['20', '30', '15', '25'],
        '8' => ['17', '27', '12', '19'],
        '9' => ['43', '53', '33', '47'],
        '10' => ['132', '122', '111', '144'],
        '11' => ['12', '11', '13', '10'],
        '12' => ['70', '60', '80', '65'],
        '13' => ['50', '25', '75', '100'],
        '14' => ['50', '42', '56', '58'],
        '15' => ['43', '53', '46', '36']
    ];

    $respostas_corretas = [
        '1' => '72',
        '2' => '11.25',
        '3' => '2.828',
        '4' => '5',
        '5' => '42',
        '6' => '49',
        '7' => '20',
        '8' => '17',
        '9' => '43',
        '10' => '132',
        '11' => '12',
        '12' => '70',
        '13' => '50',
        '14' => '50',
        '15' => '43'
    ];

    // inicia sessao
    session_start();
    if (!isset($_SESSION['perguntas_respondidas'])) {
        $_SESSION['perguntas_respondidas'] = [];
        $_SESSION['pontuacao'] = 0;
        $_SESSION['vidas'] = 3;
        $_SESSION['streak'] = 0;
        $_SESSION['dicas_disponiveis'] = 0;
    }

    // escolhe uma pergunta n respondida
    $perguntas_nao_respondidas = array_diff(array_keys($perguntas), $_SESSION['perguntas_respondidas']);
    
    if (!empty($perguntas_nao_respondidas)) {
        $pergunta_escolhida = $perguntas_nao_respondidas[array_rand($perguntas_nao_respondidas)];
        $respostasEscolhidas = $respostas[$pergunta_escolhida];
        $resposta_correta = $respostas_corretas[$pergunta_escolhida];
    } else {
        // qnd todas forem respondidas
        $jogo_completo = true;
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Extensao - Jogo</title>

    <!-- bootstrap do hugasso -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <!--css-->
    <link rel="stylesheet" href="includes/css/style.css">
    
</head>

<body>
    <div class="container game-container py-4">
        <div class="card game-card">
            <div class="game-header">
                <h1 class="game-title">QuickMath</h1>
                <div class="stats">
                    <div class="stat-item">
                        <i class="bi bi-heart-fill stat-icon text-danger"></i>
                        <span id="vidas"><?= $_SESSION['vidas'] ?></span>
                    </div>
                    <div class="stat-item">
                        <i class="bi bi-star-fill stat-icon text-warning"></i>
                        <span id="pontuacao"><?= $_SESSION['pontuacao'] ?></span>
                    </div>
                    <div class="stat-item">
                        <i class="bi bi-lightning-fill stat-icon text-primary"></i>
                        <span id="streak"><?= $_SESSION['streak'] ?></span>
                    </div>
                    <div class="stat-item">
                        <i class="bi bi-lightbulb-fill stat-icon text-success"></i>
                        <span id="dicas"><?= $_SESSION['dicas_disponiveis'] ?></span>
                    </div>
                </div>
            </div>
            
            <div class="question-container">
                <?php if (isset($jogo_completo)): ?>
                    <!-- jogo concluido -->
                    <div class="text-center">
                        <h3 class="mb-4">Jogo Concluído!</h3>
                        <p class="lead">Sua pontuação final: <strong><?= $_SESSION['pontuacao'] ?></strong> pontos</p>
                        <p>Acertos: <?= count($_SESSION['perguntas_respondidas']) ?></p>
                        <button class="btn btn-primary mt-3" onclick="reiniciarJogo()">Jogar Novamente</button>
                    </div>
                <?php elseif ($_SESSION['vidas'] <= 0): ?>
                    <!-- game over -->
                    <div class="text-center">
                        <h3 class="mb-4 text-danger">Game Over!</h3>
                        <p class="lead">Você perdeu todas as vidas</p>
                        <p>Pontuação final: <strong><?= $_SESSION['pontuacao'] ?></strong> pontos</p>
                        <button class="btn btn-primary mt-3" onclick="reiniciarJogo()">Tentar Novamente</button>
                    </div>
                <?php else: ?>
                    <!-- pergunta -->
                    <div class="question-text text-center">
                        <?= $perguntas[$pergunta_escolhida]; ?>
                    </div>
                    
                    <!-- progresso -->
                    <div class="progress-container">
                        <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar" 
                                 style="width: <?= count($_SESSION['perguntas_respondidas']) / count($perguntas) * 100 ?>%" 
                                 aria-valuenow="<?= count($_SESSION['perguntas_respondidas']) ?>" 
                                 aria-valuemin="0" 
                                 aria-valuemax="<?= count($perguntas) ?>">
                            </div>
                        </div>
                        <small class="text-muted"><?= count($_SESSION['perguntas_respondidas']) ?> de <?= count($perguntas) ?> perguntas</small>
                    </div>
                    
                    <!-- botoes respostas -->
                    <div class="row g-3 justify-content-center mt-3" id="respostas-container">
                        <?php foreach ($respostasEscolhidas as $index => $resposta) { ?>
                            <div class="col-md-6 col-12">
                                <button class="btn btn-primary answer-btn w-100" 
                                        type="button" 
                                        onclick="verificarResposta(this, '<?= $resposta ?>', '<?= $resposta_correta ?>', '<?= $pergunta_escolhida ?>')">
                                    <?= $resposta ?>
                                </button>
                            </div>
                        <?php } ?>
                    </div>
                    
                    <!-- feedback -->
                    <div id="feedback" class="text-center mt-3"></div>
                <?php endif; ?>
            </div>
            
            <div class="game-footer text-center">
                <button class="btn btn-warning tool-btn bi bi-lightbulb" <?= $_SESSION['dicas_disponiveis'] <= 0 ? 'disabled' : '' ?> onclick="usarDica()"></button>
                <button class="btn btn-danger tool-btn bi bi-arrow-clockwise" onclick="reiniciarJogo()"></button>
                <button class="btn btn-success tool-btn bi bi-bar-chart"></button>
            </div>
        </div>
    </div>

    <script src="includes/js/script.js"></script>
    <!--bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- bootstrap do hugasso -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
        crossorigin="anonymous"></script>
        <script>
            function verificarResposta(button, resposta, respostaCorreta, perguntaId) {
                // desabilita os botoes p n deixar mais de 1 resposta
                document.querySelectorAll('.answer-btn').forEach(btn => {
                    btn.disabled = true;
                });
                
                const feedback = document.getElementById('feedback');
                
                if (resposta === respostaCorreta) {
                    // resposta certa
                    button.classList.remove('btn-primary');
                    button.classList.add('btn-success');
                    feedback.innerHTML = '<div class="alert alert-success">Resposta correta! +10 pontos 🎉</div>';
                    
                    // atualiza ponto
                    atualizarPontuacao(true, perguntaId);
                } else {
                    // resposta errada
                    button.classList.remove('btn-primary');
                    button.classList.add('btn-danger');
                    feedback.innerHTML = '<div class="alert alert-danger">Resposta incorreta! A correta era: ' + respostaCorreta + '</div>';
                    
                    // mostra a certa
                    document.querySelectorAll('.answer-btn').forEach(btn => {
                        if (btn.textContent.trim() === respostaCorreta) {
                            btn.classList.remove('btn-primary');
                            btn.classList.add('btn-success');
                        }
                    });
                    
                    // atualiza vidas
                    atualizarPontuacao(false, perguntaId);
                }
            }
        
            function atualizarPontuacao(acertou, perguntaId) {
                const formData = new FormData();
                formData.append('acertou', acertou);
                formData.append('pergunta_id', perguntaId);
                
                fetch('atualizar.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // atualiza valores da tela
                        document.getElementById('pontuacao').textContent = data.pontuacao;
                        document.getElementById('vidas').textContent = data.vidas;
                        document.getElementById('streak').textContent = data.streak;
                        document.getElementById('dicas').textContent = data.dicas_disponiveis;
                        
                        // se tiver vida, carrega a prox pergunta dps de 2 sec
                        if (data.vidas > 0 && !data.jogo_completo) {
                            setTimeout(() => {
                                window.location.reload();
                            }, 2000);
                        } else if (data.vidas <= 0 || data.jogo_completo) {
                            // atualiza a pagina p mostrar tela de fim de jogo
                            setTimeout(() => {
                                window.location.reload();
                            }, 1500);
                        }
                    }
                });
            }
            
            function usarDica() {
                fetch('usar_dica.php')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // remove 2 erradas
                        const respostasErradas = Array.from(document.querySelectorAll('.answer-btn'))
                            .filter(btn => !btn.classList.contains('btn-success') && btn.textContent.trim() !== '<?= $resposta_correta ?>');
                        
                        // shuffle e pega 2 erradas pra remover
                        respostasErradas.sort(() => Math.random() - 0.5);
                        for (let i = 0; i < 2 && i < respostasErradas.length; i++) {
                            respostasErradas[i].style.display = 'none';
                        }
                        
                        // atualiza contador de dicas
                        document.getElementById('dicas').textContent = data.dicas_disponiveis;
                        
                        // desabilita o botao se n tiver mais dica
                        if (data.dicas_disponiveis <= 0) {
                            document.querySelector('.bi-lightbulb').parentElement.disabled = true;
                        }
                    }
                });
            }
            
            function reiniciarJogo() {
                fetch('reiniciar.php')
                .then(() => {
                    window.location.reload();
                });
            }
        </script>
</body>

</html>