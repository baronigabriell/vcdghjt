<?php
include 'conecta.php';

if (!$conexao) {
    die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
}


$query = "SELECT jogador_1, jogador_2, jogador_3, jogador_4, jogador_5, jogador_6
          FROM jogadores
          ORDER BY jogadores_id DESC
          LIMIT 1";

$result = mysqli_query($conexao, $query);
$jogadores = [];

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    // Coleta os nomes dos jogadores e ignora os vazios
    foreach ($row as $jogador) {
        if (!empty($jogador)) {
            $jogadores[] = $jogador;
        }
    }

    shuffle($jogadores); // embaralha a ordem
} else {
    echo "<p style='color:red;'>Nenhum jogador encontrado!</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<style>
    #ordem{
        background-color: #fffaeb;
      position: absolute;
      padding: 40px;
      border-radius: 30px;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      font-family: outfit;
    }
    body{
        background-color: #105652;
    }
    .position{
        width: 30px;
        height: 30px;
        border:rgb(32, 149, 143) 4px outset;
        border-radius: 15px;
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .player {
        display: flex;
        align-items: center;  /* Alinha verticalmente */
        gap: 10px;            /* Espaçamento entre número e nome */
        margin-bottom: 10px;  /* Espaço entre jogadores */
        font-size: 18px;
        }
</style>
<body>
    <div id="ordem">
        <h1 style="color: #105652;">Ordem dos jogadores</h1>
        <?php foreach ($jogadores as $i => $nome): ?>
        <div class="player">
        <div class="position"><?= $i + 1 ?></div>
        <div><?= htmlspecialchars(ucwords(strtolower($nome))) ?></div>
        </div>
    <?php endforeach; ?>
    </div>
</body>

</html>