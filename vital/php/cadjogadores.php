<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <title>Document</title>
    <style>
    body{
        font-family: outfit;
        background-image: url(../img/floresta3.png);
        background-size: cover;
    }
    #jogadoresInputs input {
      display: block;
      margin-bottom: 10px;
      opacity: 0;
      max-height: 0;
      transition: opacity 0.5s ease, max-height 0.5s ease;
      overflow: hidden;
    }
    #jogadoresInputs input.visible {
      opacity: 1;
      max-height: 50px;
    }
    svg{
        height: 20px;
        fill: white;
    }
    input{
        width: 60vh;
        height: 6vh;
        outline: none;
        font-size: 15px;
        font-family: outfit;
    }
    div{
        text-align: center;
    }
  </style>
</head>
<body>
    <div class="preloader" id="preloader">
        <div class="loader" id="loader"></div>
    </div>
    <h1 style="color: white;">Cadastro de Jogadores</h1>

<form id="cadastroForm">
  <div id="jogadoresInputs">
    <input type="text" name="jogador" placeholder="Nome do jogador 1" required class="visible" />
    <input type="text" name="jogador" placeholder="Nome do jogador 2" required class="visible" />
    <input type="text" name="jogador" placeholder="Nome do jogador 3" required class="visible" />
    <input type="text" name="jogador" placeholder="Nome do jogador 4" required class="visible" />
    <!-- Inputs extras escondidos inicialmente -->
    <input type="text" name="jogador" placeholder="Nome do jogador 5" />
    <input type="text" name="jogador" placeholder="Nome do jogador 6" />
  </div>

  <button type="button" id="addJogadorBtn"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z"/></svg></button><br/><br/>
  <button type="submit">Começar jogo</button>
</body>
<script>
        let elem_preloader = document.getElementById("preloader");
    let elem_loader = document.getElementById("loader");
    console.log("Testing... Ok");


    setTimeout(function() {
        elem_preloader.classList.remove("preloader");
        elem_loader.classList.remove("loader");
        }, 1280);

        const maxJogadores = 6;
    const minJogadores = 4;

    const jogadoresInputsDiv = document.getElementById('jogadoresInputs');
    const addJogadorBtn = document.getElementById('addJogadorBtn');
    const cadastroForm = document.getElementById('cadastroForm');

    addJogadorBtn.addEventListener('click', () => {
      const inputs = jogadoresInputsDiv.querySelectorAll('input[name="jogador"]');
      let nextInput = null;
      for (let i = 0; i < inputs.length; i++) {
        if (!inputs[i].classList.contains('visible')) {
          nextInput = inputs[i];
          break;
        }
      }

      if (nextInput) {
        nextInput.classList.add('visible');
      } else {
        alert(`O máximo de jogadores é ${maxJogadores}`);
      }
    });

    cadastroForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const jogadores = Array.from(cadastroForm.querySelectorAll('input[name="jogador"].visible'))
                            .map(input => input.value.trim())
                            .filter(nome => nome !== '');

      if (jogadores.length < minJogadores) {
        alert(`É necessário pelo menos ${minJogadores} jogadores.`);
        return;
      }

      // Aqui você manda os jogadores pro banco ou faz o que quiser
      alert(`Jogadores cadastrados: ${jogadores.join(', ')}`);
    });
</script>
</html>