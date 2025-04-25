<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <title>Página inicial</title>
</head>
<body>
<main id="main-index">
    <div id="home-screen">
        <button id="play-button">Jogar</button>
    </div>
    <div id="game-info" class="hidden" onclick="redirecionarPagina()">
        <h1>Bem-vindo ao jogo!</h1>
        <p>Aqui vão as informações do jogo...</p>
    </div>
</main>

</body>
<script>
    const playButton = document.getElementById('play-button');
    const homeScreen = document.getElementById('home-screen');
    const gameInfo = document.getElementById('game-info');

    playButton.addEventListener('click', () => {
        playButton.style.animation = ''; 

        playButton.style.animation = 'buttonDisappear 0.9s forwards';

        setTimeout(() => {
            homeScreen.style.display = 'none'; 
            gameInfo.classList.remove('hidden');
            gameInfo.classList.add('visible');
        }, 900); 
    });

    function redirecionarPagina() {
        window.location.href = "paginainicial.php";
    }

</script>

</html>