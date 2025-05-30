<?php
include "conecta.php";

if (isset($_POST['jogador']) && is_array($_POST['jogador'])) {
    $jogadores = $_POST['jogador'];

    // Garante 6 valores (ou null)
    for ($i = 0; $i < 6; $i++) {
        if (!isset($jogadores[$i]) || trim($jogadores[$i]) == '') {
            $jogadores[$i] = null;
        } else {
            $jogadores[$i] = mysqli_real_escape_string($conexao, $jogadores[$i]);
        }
    }

    $query = "INSERT INTO jogadores (jogador_1, jogador_2, jogador_3, jogador_4, jogador_5, jogador_6) VALUES (
        '".($jogadores[0] ?? '')."',
        '".($jogadores[1] ?? '')."',
        '".($jogadores[2] ?? '')."',
        '".($jogadores[3] ?? '')."',
        '".($jogadores[4] ?? '')."',
        '".($jogadores[5] ?? '')."'
    )";

    $resultado = mysqli_query($conexao, $query);

    if ($resultado) {
        echo "Jogadores salvos com sucesso!";
    } else {
        echo "Erro ao salvar jogadores: " . mysqli_error($conexao);
    }
} else {
    echo "Nenhum jogador enviado.";
}

mysqli_close($conexao);
?>
