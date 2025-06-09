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
    <div class="menu-container">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" id="bars">
            <path d="M0 96C0 78.3 14.3 64 32 64l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 128C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32L32 448c-17.7 0-32-14.3-32-32s14.3-32 32-32l384 0c17.7 0 32 14.3 32 32z" />
        </svg>
        <nav id="menu" class="menu">
            <ul>
                <li><a href="index.php">Começo</a></li>
                <li><a href="dadofase1.php">Fase 1</a></li>
                <li><a href="dadofase2.php">Fase 2</a></li>
                <li><a href="dadofase3.php">Fase 3</a></li>
                <li><a href="dadofase4.php">Fase 4</a></li>
            </ul>
        </nav>
    </div>

    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" id="seta" onclick="redirecionarPagina()">
        <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
    </svg>


    <main id="main-dado">
        <div class="container">
            <div class="dice <?php echo $bloqueado ? 'bloqueado' : ''; ?>" <?php echo $bloqueado ? 'title="Jogador bloqueado nesta rodada"' : ''; ?>>
                <div class="face front"></div>
                <div class="face back"></div>
                <div class="face top"></div>
                <div class="face bottom"></div>
                <div class="face right"></div>
                <div class="face left"></div>
            </div>
            <button class="roll <?php echo $bloqueado ? 'bloqueado' : ''; ?>" <?php echo $bloqueado ? 'disabled' : ''; ?>>
                <p>Jogar dado</p>
            </button>
            <button style="margin-top: 20px;" onclick="avancarJogador()">Seguir</button>
        </div>

        <div class="carta <?php echo $bloqueado ? 'bloqueado' : ''; ?>"
            <?php if (!$bloqueado): ?>onclick="window.location.href='quizfase3.php'" <?php endif; ?>>
        </div>

        <!-- Exibe o jogador da vez -->
        <h2><?php echo htmlspecialchars(ucwords(strtolower($jogador_da_vez))) ?>, agora é sua vez!</h2>

    </main>
    <div style="display: inline;">
        <button id="fase2" onclick="redirecionarPaginaFase2()">Voltar para a 2ª fase</button>
        <button id="fase4" onclick="redirecionarPaginaFase4()">Ir para a 4ª fase</button>
    </div>
    <?php
    // DEBUG: Verificar status do jogador atual
    $debug_query = "SELECT * FROM jogadores_status WHERE nome = '$jogador_da_vez'";
    $debug_result = mysqli_query($conexao, $debug_query);
    $debug_data = mysqli_fetch_assoc($debug_result);
    error_log("DEBUG - Jogador: $jogador_da_vez, Status: " . print_r($debug_data, true));
    ?>

    <div id="floatingBtnContainer">
        <button id="floatingBtn" aria-label="Abrir busca"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                <path d="M24 32C10.7 32 0 42.7 0 56L0 456c0 13.3 10.7 24 24 24l16 0c13.3 0 24-10.7 24-24L64 56c0-13.3-10.7-24-24-24L24 32zm88 0c-8.8 0-16 7.2-16 16l0 416c0 8.8 7.2 16 16 16s16-7.2 16-16l0-416c0-8.8-7.2-16-16-16zm72 0c-13.3 0-24 10.7-24 24l0 400c0 13.3 10.7 24 24 24l16 0c13.3 0 24-10.7 24-24l0-400c0-13.3-10.7-24-24-24l-16 0zm96 0c-13.3 0-24 10.7-24 24l0 400c0 13.3 10.7 24 24 24l16 0c13.3 0 24-10.7 24-24l0-400c0-13.3-10.7-24-24-24l-16 0zM448 56l0 400c0 13.3 10.7 24 24 24l16 0c13.3 0 24-10.7 24-24l0-400c0-13.3-10.7-24-24-24l-16 0c-13.3 0-24 10.7-24 24zm-64-8l0 416c0 8.8 7.2 16 16 16s16-7.2 16-16l0-416c0-8.8-7.2-16-16-16s-16 7.2-16 16z" />
            </svg></button>

        <div id="popupContent">
            <input type="text" id="hiddenInput" placeholder="Bipe o código aqui" autocomplete="off" />
            <button onclick="buscarAnimal()">Pesquisar</button>
        </div>
    </div>

    <div id="animalPopup">
        <h2 id="animalNome"></h2>
        <img id="animalImagem" />
        <audio id="animalSom" controls autoplay></audio>
        <p id="animalDescricao"></p>
        <button onclick="fecharPopup()">Fechar</button>
    </div>

    <script src="../css/dados.js"></script>

    <script>
        const dice = document.querySelector('.dice');
        const rollBtn = document.querySelector('.roll');

        const randomDice = () => {
            const random = Math.floor(Math.random() * 6) + 1; // Garante que o número seja de 1 a 6
            rollDice(random);
        }

        const rollDice = random => {
            dice.style.animation = 'rolling 4s';
            setTimeout(() => {
                switch (random) {
                    case 1:
                        dice.style.transform = 'rotateX(0deg) rotateY(0deg)';
                        break;
                    case 6:
                        dice.style.transform = 'rotateX(180deg) rotateY(0deg)';
                        break;
                    case 2:
                        dice.style.transform = 'rotateX(-90deg) rotateY(0deg)';
                        break;
                    case 5:
                        dice.style.transform = 'rotateX(90deg) rotateY(0deg)';
                        break;
                    case 3:
                        dice.style.transform = 'rotateX(0deg) rotateY(90deg)';
                        break;
                    case 4:
                        dice.style.transform = 'rotateX(0deg) rotateY(-90deg)';
                        break;
                    default:
                        break;
                }
                dice.style.animation = 'none';
            }, 4050);
        }

        rollBtn.addEventListener('click', randomDice);

        function redirecionarPagina() {
            window.location.href = "paginainicial.php";
        }

        function redirecionarPaginaSeguir() {
            window.location.href = "dadofase3.php";
        }

        function redirecionarPaginaQuiz() {
            window.location.href = "quizfase3.php";
        }

        function redirecionarPaginaFase4() {
            window.location.href = "dadofase4.php";
        }

        function redirecionarPaginaFase2() {
            window.location.href = "dadofase2.php";
        }

        const hamburger = document.getElementById('bars');
        const menu = document.getElementById('menu');

        hamburger.addEventListener('click', () => {
            menu.classList.toggle('active');
            hamburger.classList.toggle('active');
        });

        function avancarJogador() {
            fetch('avancar_jogador.php')
                .then(response => {
                    if (!response.ok) throw new Error('Erro na rede');
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        window.location.reload(); // Recarrega a página
                    }
                })
                .catch(error => {
                    console.error('Erro:', error);
                    alert('Erro ao avançar jogador');
                });
        }

        const floatingBtn = document.getElementById('floatingBtn');
        const popupContent = document.getElementById('popupContent');
        const input = document.getElementById('hiddenInput');

        floatingBtn.addEventListener('click', () => {
            if (popupContent.style.display === 'block') {
                popupContent.style.display = 'none';
                input.value = '';
                input.blur();
            } else {
                popupContent.style.display = 'block';
                input.focus();
            }
        });

        function buscarAnimal() {
            const codigo = input.value.trim();
            if (codigo === '') {
                alert("Por favor, insira ou bip o código.");
                return;
            }
            if (animais[codigo]) {
                const animal = animais[codigo];
                document.getElementById("animalNome").textContent = animal.nome;
                document.getElementById("animalImagem").src = animal.imagem;
                document.getElementById("animalSom").src = animal.som;
                document.getElementById("animalDescricao").textContent = animal.descricao;
                document.getElementById("animalPopup").style.display = "block";
            } else {
                alert("Animal não encontrado! Código: " + codigo);
            }
            input.value = "";
            input.focus();
        }

        function fecharPopup() {
            document.getElementById("animalPopup").style.display = "none";
            document.getElementById("animalSom").pause();
            input.focus();
        }

        // Detecta quando o scanner "envia" o código + Enter para disparar busca automática
        input.addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                buscarAnimal();
            }
        });

        // Bloqueia as teclas 13 (Enter), 17 (Ctrl) e 74 (J) apenas se NÃO estiver focado no input
        document.addEventListener('keydown', function(event) {
            if (event.keyCode == 13 || event.keyCode == 17 || event.keyCode == 74) event.preventDefault();
        });
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

    #fase2{
        width: 180px;
        margin-left: 15%;
        margin-top: 5%;
        z-index: 10;
        background-color: #76976f;
    }

    #fase2:hover {
        background-color: #244937;
    }

    #fase4 {
        width: 180px;
        margin-left: 50.4%;
        margin-top: 5%;
        z-index: 10;
        background-color: #76976f;
    }

    #fase4:hover {
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
    #animalNome{
        font-family: outfit;
        color: black;
        font-style: normal;
    }
    #animalDescricao{
        margin: 2%;
    }
</style>

</html>