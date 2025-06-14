<?php
include 'conecta.php';

// Verifique a conexão
if (!$conexao) {
    die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
}

// Recupera a ordem dos jogadores e o índice da vez
$query = "SELECT ordem_jogo, indice_vez FROM jogadores ORDER BY jogadores_id DESC LIMIT 1";
$result = mysqli_query($conexao, $query);
$jogadores = [];
$indice_vez = 0;

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $jogadores = json_decode($row['ordem_jogo'], true);
    $indice_vez = $row['indice_vez']; // Recupera o índice da vez
}

// Exibe o nome do jogador da vez
$jogador_da_vez = $jogadores[$indice_vez];

// Atualiza o índice para o próximo jogador
$indice_vez = ($indice_vez + 1) % count($jogadores); // Quando chega no final da lista, começa novamente

// Atualiza o banco de dados com o novo índice de vez
$update_vez = "UPDATE jogadores 
               JOIN (SELECT MAX(jogadores_id) AS id FROM jogadores) AS ult 
               ON jogadores.jogadores_id = ult.id 
               SET jogadores.indice_vez = $indice_vez";

mysqli_query($conexao, $update_vez);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <title>Dado</title>
</head>
<body>
    <div class="menu-container">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" id="bars">
            <path d="M0 96C0 78.3 14.3 64 32 64l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 128C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32L32 448c-17.7 0-32-14.3-32-32s14.3-32 32-32l384 0c17.7 0 32 14.3 32 32z" />
        </svg>
        <nav id="menu" class="menu">
            <ul>
                <li><a href="paginainicial.php">Página inicial</a></li>
                <li><a href="tabuleiro.php">Tabuleiro</a></li>
                <li><a href="dado.php">Dado</a></li>
                <li><a href="personagens.php">Personagens</a></li>
                <li><a href="pontuacao.php">Vidas</a></li>
            </ul>
        </nav>
    </div>

    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" id="seta" onclick="redirecionarPagina()">
        <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
    </svg>

    <main id="main-dado">
        <div class="container">
            <div class="dice">
                <div class="face front"></div>
                <div class="face back"></div>
                <div class="face top"></div>
                <div class="face bottom"></div>
                <div class="face right"></div>
                <div class="face left"></div>
            </div>
            <button class="roll">
                <p>Jogar dado</p>
            </button>
            <button style="margin-top: 20px;" onclick="redirecionarPaginaSeguir()">Seguir</button>
        </div>

        <!-- Exibe o jogador da vez -->
        <h2><?php echo htmlspecialchars(ucwords(strtolower($jogador_da_vez))) ?>, agora é sua vez!</h2>

        <div class="carta" onclick="redirecionarPaginaQuiz()"></div>
    </main>

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
            window.location.href = "quiz.php";
        }

        function redirecionarPaginaQuiz() {
            window.location.href = "quiz.php";
        }

        const hamburger = document.getElementById('bars');
        const menu = document.getElementById('menu');

        hamburger.addEventListener('click', () => {
            menu.classList.toggle('active');
            hamburger.classList.toggle('active');
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
        width: 250px;
        height: 400px;
        background-image: url(../img/carta.png);
        background-size: 12vw 30vh;
        border-radius: 30px;
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
</style>
</html>
