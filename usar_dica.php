<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_SESSION['dicas_disponiveis'] > 0) {
    $_SESSION['dicas_disponiveis']--;
    
    echo json_encode([
        'success' => true,
        'dicas_disponiveis' => $_SESSION['dicas_disponiveis']
    ]);
} else {
    echo json_encode([
        'success' => false
    ]);
}
?>