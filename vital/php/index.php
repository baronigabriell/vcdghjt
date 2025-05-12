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
    <div id="background-split">
        <div class="left-bg"></div>
        <div class="right-bg"></div>
    </div>

    <div id="home-screen">
        <button id="play-button">Jogar</button>
    </div>

    <div id="envelope-container" class="hidden">
        <div class="wrapper">
            <div class="fundo"></div>
            <div class="lid one"></div>
            <div class="lid two"></div>
            <div class="envelope"></div>
            <div class="letter">
                <p>Gabriel, Goevana<br>Júlia e Wina</p>
            </div>
        </div>
    </div>
</main>


</body>
<script>
const playButton = document.getElementById('play-button');
const leftBg = document.querySelector('.left-bg');
const rightBg = document.querySelector('.right-bg');
const envelopeContainer = document.getElementById('envelope-container');

// Função que é chamada quando o botão é clicado
playButton.addEventListener('click', () => {
    // Aplica a animação de desaparecer no botão
    playButton.style.animation = 'buttonDisappear 0.9s forwards';

    // Remove a classe 'hidden' e adiciona a classe 'visible' para mostrar o envelope
    envelopeContainer.classList.remove('hidden');
    envelopeContainer.classList.add('visible');

    // Após o clique, move as metades do fundo
    setTimeout(() => {
        leftBg.classList.add('open-left');
        rightBg.classList.add('open-right');
    }, 500); // Um pequeno delay para a animação do botão desaparecer
});



</script>




</html>