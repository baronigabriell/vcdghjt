<?php
session_start();
include 'conecta.php';

$query = "UPDATE jogadores SET indice_vez = (indice_vez + 1) % 
          (SELECT COUNT(*) FROM JSON_TABLE(ordem_jogo, '$[*]' COLUMNS(nome VARCHAR(255) PATH '$')) AS jt) 
          ORDER BY jogadores_id DESC LIMIT 1";
mysqli_query($conexao, $query);
echo json_encode(['success' => true]);
?>