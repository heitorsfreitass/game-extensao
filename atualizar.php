<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acertou = $_POST['acertou'] === 'true';
    $perguntaId = $_POST['pergunta_id'];
    
    if (!in_array($perguntaId, $_SESSION['perguntas_respondidas'])) {
        $_SESSION['perguntas_respondidas'][] = $perguntaId;
        
        if ($acertou) {
            $_SESSION['pontuacao'] += 10;
            $_SESSION['streak']++;
            
            // ganha 1 dica a cada 3 consecutivas
            if ($_SESSION['streak'] % 3 === 0) {
                $_SESSION['dicas_disponiveis']++;
            }
        } else {
            $_SESSION['vidas']--;
            $_SESSION['streak'] = 0;
        }
    }
    
    echo json_encode([
        'success' => true,
        'pontuacao' => $_SESSION['pontuacao'],
        'vidas' => $_SESSION['vidas'],
        'streak' => $_SESSION['streak'],
        'dicas_disponiveis' => $_SESSION['dicas_disponiveis'],
        'jogo_completo' => count($_SESSION['perguntas_respondidas']) >= 15
    ]);
}
?>