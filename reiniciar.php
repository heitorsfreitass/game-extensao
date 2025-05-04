<?php
session_start();

// reseta as session variables
$_SESSION['perguntas_respondidas'] = [];
$_SESSION['pontuacao'] = 0;
$_SESSION['vidas'] = 3;
$_SESSION['streak'] = 0;
$_SESSION['dicas_disponiveis'] = 0;

echo json_encode(['success' => true]);
?>