<?php
session_start();
include 'conecta.php';

if (!$conexao) {
    die("Falha na conexão: " . mysqli_connect_error());
}

// Recupera ordem e índice
$query = "SELECT jogadores_id, ordem_jogo, indice_vez FROM jogadores ORDER BY jogadores_id DESC LIMIT 1";
$result = mysqli_query($conexao, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $jogadores_id = $row['jogadores_id'];
    $jogadores = json_decode($row['ordem_jogo'], true);
    $indice_vez = $row['indice_vez'];

    // Verificação de bloqueio (única e consolidada)
    $jogador_da_vez = $jogadores[$indice_vez];
    $bloqueado = 0;

    $querySkip = "SELECT has_skip FROM jogadores_status WHERE nome = '$jogador_da_vez'";
    $resSkip = mysqli_query($conexao, $querySkip);

    if ($resSkip && mysqli_num_rows($resSkip) > 0) {
        $skip = mysqli_fetch_assoc($resSkip)['has_skip'];
        if ($skip == 1) {
            mysqli_query($conexao, "UPDATE jogadores_status SET has_skip = 0 WHERE nome = '$jogador_da_vez'");
            $indice_vez = ($indice_vez + 1) % count($jogadores);
            $jogador_da_vez = $jogadores[$indice_vez];
            $bloqueado = 1; // Marca como bloqueado para efeitos visuais
        }
    }

    $_SESSION['jogador_atual'] = $jogador_da_vez;
    $_SESSION['indice_vez'] = $indice_vez;

    // Atualiza banco
    $updateIndice = "UPDATE jogadores SET indice_vez = $indice_vez WHERE jogadores_id = $jogadores_id";
    mysqli_query($conexao, $updateIndice);

    // DEBUG
    error_log("Jogador atual: $jogador_da_vez, Índice: $indice_vez, Bloqueado: $bloqueado");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .bloqueado {
            cursor: not-allowed !important;
            opacity: 0.5;
            pointer-events: none;
        }

        .cursor-bloqueado {
            cursor: not-allowed;
        }
    </style>
    <title>Dado</title>
</head>

<body>


    <div style="color: white; text-align: center; top: 50%; left:50%; transform:translate(-50%,-50%); position: absolute;">
        <h1>Parabéns, você chegou ao final!</h1>
        <p>Obrigado por ter embarcado nessa aventura conosco.
            <br>Se sinta sempre bem-vindo quando quiser jogar novamente!
        </p>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.2/dist/confetti.browser.min.js"></script>
    <script>
        window.onload = () => {
            let params = {
                particleCount: 500, // Quantidade de confetes
                spread: 90, // O quanto eles se espalham
                startVelocity: 70, // Velocidade inicial
                origin: {
                    x: 0,
                    y: 0.5
                }, // Posição inicial na tela
                angle: 45 // Ângulo em que os confetes serão lançados
            };

            // Joga confetes da esquerda pra direita
            confetti(params);

            // Joga confetes da direita para a esquerda
            params.origin.x = 1;
            params.angle = 135;
            confetti(params);
        };
    </script>

</body>

</html>

<style>
    #seta {
        fill: white;
        height: 20px;
        margin-left: 50px;
        margin-top: 50px;
    }

    .container {
        margin-top: 10%;
    }

    body {
        background-image: url(../img/fundo.png);
        background-size: 100vw 100vh;
        font-family: outfit;
    }

    main {
        display: flex;
        justify-content: center;
        text-align: center;
    }

    .menu {
        background-color: #fafff0;
    }

    .menu ul li a {
        text-decoration: none;
        color: #244937;
        font-size: 18px;
    }

    #bars {
        background-color: #fafff0;
        fill: #244937;
    }

    .carta {
        margin-top: 10%;
        width: 324px;
        height: 400px;
        background-image: url(../img/interrogacao.jpeg);
        background-size: cover;
        margin-left: 4%;
    }

    .carta:hover {
        transform: scale(1.2);
        transition: 0.5s all ease-in-out;
        cursor: pointer;
    }

    .carta:not(:hover) {
        transform: scale(1);
        transition: 0.5s all ease-out;
    }

    h2 {
        color: #999999;
        font-style: italic;
        font-family: outfit;
        white-space: nowrap;
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
    }

    #fase2 {
        width: 180px;
        margin-left: 75%;
        margin-top: 5%;
        z-index: 10;
        background-color: #76976f;
    }

    #fase2:hover {
        background-color: #244937;
    }

    #floatingBtnContainer {
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 1000;
        user-select: none;
    }

    #floatingBtn {
        width: 60px;
        height: 60px;
        background: #76976f;
        border-radius: 50%;
        border: none;
        color: white;
        font-size: 30px;
        cursor: pointer;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        fill: white;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    svg {
        width: 30px;
    }

    #floatingBtn:hover {
        transition: 0.5s all ease-one-in;
        background: #244937;

    }

    #popupContent {
        position: absolute;
        bottom: 70px;
        right: 0;
        width: 320px;
        background-color: #fffaeb;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 0 25px rgba(0, 0, 0, 0.25);
        display: none;

    }

    #hiddenInput {
        font-size: 18px;
        width: 200px;
        height: 6vh;
        border-radius: 10px;
        margin-right: 10px;
        border: 2px solid #105652;
        padding-left: 12px;
        background-color: #fffaeb;
        transition: 0.4s all ease-in;
        font-family: outfit;
        outline: none;
    }

    #hiddenInput.filled {
        box-shadow: inset 0 0 4px rgba(0, 0, 10, 0.5);
    }


    #popupContent button {
        padding: 10px 20px;
        background: #244937;
        border: none;
        color: white;
        font-size: 18px;
        border-radius: 20px;
        margin-top: 10px;
        cursor: pointer;
    }

    #popupContent button:hover {
        background: #76976f;
        transition: 0.5 all ease-in-out;
    }

    #animalPopup {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #fffaeb;
        border-radius: 15px;
        padding: 20px;
        width: 80%;
        max-width: 500px;
        box-shadow: 0 0 25px rgba(0, 0, 0, 0.2);
        z-index: 1100;
        font-family: outfit;
    }

    #animalPopup img {
        width: 100%;
        max-height: 680px;
        object-fit: cover;
        border-radius: 10px;
    }

    #animalPopup button {
        background: #244937;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 50px;
        cursor: pointer;
        font-size: 16px;
        margin-top: 15px;
    }

    #animalPopup button:hover {
        background: #76976f;
        transition: 0.5 all ease-in-out;
    }

    #animalNome {
        font-family: outfit;
        color: black;
        font-style: normal;
    }

    #animalDescricao {
        margin: 2%;
    }
</style>

</html>