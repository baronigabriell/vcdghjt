<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <title>Document</title>
</head>
<body>
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" id="seta" onclick="redirecionarPagina()"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg>

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
                <h2>Jogar dado</h2>
            </button>
        </div>
    </main>
    <script>
        const dice = document.querySelector('.dice');
        const rollBtn = document.querySelector('.roll');


        const randomDice = () =>{
            const random = Math.floor(Math.random() * 10);
            if(random >= 1 && random <= 6){
                rollDice(random);
            }else{
                randomDice();
            }
        }

        const rollDice = random =>{
            dice.style.animation = 'rolling 4s';
            setTimeout(() =>{
                switch (random) {
                    case 1: dice.style.transform = 
                    'rotateX(0deg) rotateY(0deg)';
                    break;
                    case 6: dice.style.transform = 
                    'rotateX(180deg) rotateY(0deg)';
                    break;
                    case 2: dice.style.transform = 
                    'rotateX(-90deg) rotateY(0deg)';
                    break;
                    case 5: dice.style.transform = 
                    'rotateX(90deg) rotateY(0deg)';
                    break;
                    case 3: dice.style.transform = 
                    'rotateX(0deg) rotateY(90deg)';
                    break;
                    case 4: dice.style.transform = 
                    'rotateX(0deg) rotateY(-90deg)';
                    break;

                    default: break;
                }
                dice.style.animation = 'none';


            },4050);
        }
        

        rollBtn.addEventListener('click', randomDice);

        function redirecionarPagina() {
            window.location.href = "paginainicial.php";
        }
    </script>
</body>
<style>
    #seta{
        fill: white;
        height: 20px;
        margin-left: 50px;
        margin-top: 50px;
    }
    .container{
        margin-top: 10%;
    }
    body{
        background-color: #244937;
        height: 100vh;
    }
    main{
        display: flex;
        justify-content: center;
        text-align: center;
    }
</style>
</html>