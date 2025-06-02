<?php
include 'conecta.php';
if (!$conexao) {
    die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
}
$query = "SELECT jogador_1, jogador_2, jogador_3, jogador_4, jogador_5, jogador_6, ordem_jogo
          FROM jogadores
          ORDER BY jogadores_id DESC
          LIMIT 1";

$result = mysqli_query($conexao, $query);
$jogadores = [];

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    if (!empty($row['ordem_jogo'])) {
        $jogadores = json_decode($row['ordem_jogo'], true);
    } else {
        foreach ($row as $chave => $jogador) {
            if (strpos($chave, 'jogador_') === 0 && !empty($jogador)) {
                $jogadores[] = $jogador;
            }
        }

        shuffle($jogadores); 
        $ordem_json = json_encode($jogadores);
        $update = "UPDATE jogadores SET ordem_jogo = '" . mysqli_real_escape_string($conexao, $ordem_json) . "' 
                   WHERE jogadores_id = (SELECT MAX(jogadores_id) FROM jogadores)";
        mysqli_query($conexao, $update);
    }
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
        background-image: url(../img/fundo.png);
        background-size: 100vw 100vh;
    }
    .position{
        width: 30px;
        height: 30px;
        border:hsl(151, 43.60%, 30.60%) 4px outset;
        border-radius: 15px;
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .player {
        display: flex;
        align-items: center; 
        gap: 10px;            
        margin-bottom: 10px; 
        font-size: 18px;
    }
    #vez {
        margin-top: 20px;
        font-size: 18px;
        color:rgb(104, 104, 104);
        font-style: italic;
        text-align: center;
    }
    button {
        height: 50px;
        width: 120px;
        font-size: 17px;
        border: none;
        background-color: #244937;
        border-radius: 30px;
        color: white;
        font-family: outfit;
        align-items: center;
    }

    button:hover {
        background-color: #76976f;
        cursor: pointer;
        transform: scale(1.1);
        transition: all 0.4s ease-in-out;

    }

    button:not(:hover) {
        background-color: #244937;
        transition: all 0.4s ease-in-out;
    }

    button:active {
        transform: scale(1);
    }
</style>
<body>
    <div id="ordem">
        <h1 style="color: #244937;">Ordem dos jogadores</h1>
        <?php foreach ($jogadores as $i => $nome): ?>
        <div class="player">
        <div class="position"><?= $i + 1 ?></div>
        <div><?= htmlspecialchars(ucwords(strtolower($nome))) ?></div>
        </div>
        <?php endforeach; ?>
        <?php if (!empty($jogadores)): ?>
            <p id="vez"><?= htmlspecialchars(ucwords(strtolower($jogadores[0]))) ?>, agora é sua vez!</p>
        <?php endif; ?>
        <button type="button" id="comecarJogo" onclick="redirecionarPagina()">Seguir</button>
    </div>
</body>
<script>
    function redirecionarPagina() {
      window.location.href = "dado.php";
    }
</script>
</html>