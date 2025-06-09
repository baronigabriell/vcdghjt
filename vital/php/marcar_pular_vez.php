<?php
session_start();
require_once 'conecta.php';

$nome = $_SESSION['jogador_atual'];
mysqli_query($conexao, "UPDATE jogadores_status SET has_skip = 1 WHERE nome = '$nome'");
?>
