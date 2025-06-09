<?php
session_start();
include 'conecta.php';

// Pega o último registro
$query = "SELECT jogadores_id, ordem_jogo, indice_vez FROM jogadores ORDER BY jogadores_id DESC LIMIT 1";
$result = mysqli_query($conexao, $query);
$row = mysqli_fetch_assoc($result);

// Calcula próximo índice
$jogadores = json_decode($row['ordem_jogo'], true);
$novo_indice = ($row['indice_vez'] + 1) % count($jogadores);

// Atualiza banco
mysqli_query($conexao, "UPDATE jogadores SET indice_vez = $novo_indice WHERE jogadores_id = {$row['jogadores_id']}");

echo json_encode(['success' => true]);
?>