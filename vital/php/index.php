<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ballet:opsz@16..72&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <title>Página inicial</title>
</head>
<body>
<main id="main-index">
    <div class="wrapper">
            <div class="fundo"></div>
            <div class="lid one"></div>
            <div class="lid two"></div>
            <div class="envelope"></div>
            <div class="letter" >
                <p>Bem-vindo viadinhx</p>
                <p style="font-family: montserrat; font-weight: 200; font-size: 5px;">Em Sobreviver na Floresta, os jogadores se encontram em uma situação extrema: perdidos no meio de uma floresta densa e implacável. A natureza selvagem, com seus perigos e recursos limitados, será tanto uma aliada quanto um adversário. O objetivo é simples, mas desafiador: sobreviver até ser resgatado ou encontrar uma maneira de escapar. Mas cuidado, a floresta não oferece perdão para aqueles que não estão preparados!</p>
                <a href="cadjogadores.php">
                <p id="continuar" onclick=" redirecionarPaginaTabu()">Continuar</p>
                </a>
            </div>
        </div>
    

    <!-- Primeiro o fundo -->
    <div id="background-split">
        <div class="left-bg"></div>
        <div class="right-bg"></div>
    </div>

    <div id="home-screen">
        <button id="play-button">Jogar</button>
    </div>
</main>
</body>

<script>
const playButton = document.getElementById('play-button');
const leftBg = document.querySelector('.left-bg');
const rightBg = document.querySelector('.right-bg');
const wrapper = document.querySelector('.wrapper');

playButton.addEventListener('click', () => {
    playButton.style.animation = 'buttonDisappear 0.9s forwards';

    wrapper.style.display = 'flex';
    // Começa a abrir os fundos
    setTimeout(() => {
        leftBg.classList.add('open-left');
        rightBg.classList.add('open-right');

        // Após o fundo começar a abrir, desativa o bloqueio de eventos de mouse
        setTimeout(() => {
            leftBg.classList.add('disable-pointer');
            rightBg.classList.add('disable-pointer');
            wrapper.style.zIndex = 1000;
        }, 1500); // dá tempo do fundo abrir visualmente (ajuste se sua animação for mais rápida/lenta)
    }, 500);
});


wrapper.addEventListener('click', () => {
    wrapper.classList.add('clicked');
});



</script>

</html>