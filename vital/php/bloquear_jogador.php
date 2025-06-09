<?php
session_start();
include 'conecta.php';

if(isset($_POST['jogador'])) {
    $jogador = mysqli_real_escape_string($conexao, $_POST['jogador']);
    
    $query = "INSERT INTO jogadores_status (nome, has_skip) VALUES ('$jogador', 1)
              ON DUPLICATE KEY UPDATE has_skip = 1";
    
    mysqli_query($conexao, $query);
    echo "OK";
}
?>