<?php
session_start();
include 'conecta.php';

if (!isset($_SESSION['indice_vez']) || !isset($_SESSION['jogador_atual'])) {
    header("Location: dadofase1.php");
    exit;
}

$query = "SELECT jogadores_id, ordem_jogo FROM jogadores ORDER BY jogadores_id DESC LIMIT 1";
$result = mysqli_query($conexao, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $jogadores_id = $row['jogadores_id'];
    $jogadores = json_decode($row['ordem_jogo'], true);
    $indice = ($_SESSION['indice_vez'] + 1) % count($jogadores);

    // Atualiza a vez no banco
    $update = "UPDATE jogadores SET indice_vez = $indice WHERE jogadores_id = $jogadores_id";
    mysqli_query($conexao, $update);

    // Redireciona pro quiz
    header("Location: quiz.php");
    exit;
}
?>
