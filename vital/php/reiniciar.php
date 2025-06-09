<?php
session_start();
$_SESSION['reiniciar_perguntas'] = true;
// Limpeza de lógicas de turno no servidor (se preciso)

// Redireciona direto para o dado
header('Location: dadofase1.php');
exit;
?>
