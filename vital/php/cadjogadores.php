<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/style.css">
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
  <title>Document</title>
  <style>
    body {
      font-family: outfit;
      background-image: url(../img/floresta3.png);
      background-size: cover;
    }

    #jogadoresInputs input {
      display: block;
      margin-bottom: 15px;
      opacity: 0;
      max-height: 0;
      transition: opacity 0.5s ease, max-height 0.5s ease;
      overflow: hidden;
    }

    #jogadoresInputs input.visible {
      opacity: 1;
      max-height: 50px;
    }

    #cadastroForm {
      background-color: #fffaeb;
      position: absolute;
      padding: 40px;
      border-radius: 30px;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }

    svg {
      height: 20px;
      fill: white;
    }

    input {
      width: 60vh;
      height: 6vh;
      outline: none;
      font-size: 15px;
      font-family: outfit;
      border-radius: 15px;
      border: 2px solid #105652;
      padding-left: 12px;
      background-color: #fffaeb;
      transition: 0.4s all ease-in;
    }

    input.filled {
      box-shadow: inset 0 0 4px rgba(0, 0, 10, 0.5);
    }

    div {
      text-align: center;
    }

    button {
      background-color: #244937;
      width: 150px;
    }

    #jogadoresInputs input {
      display: block;
      margin-bottom: 0;
      opacity: 0;
      max-height: 0;
      transition: opacity 0.5s ease, max-height 0.5s ease, margin-bottom 0.5s ease;
      overflow: hidden;
    }

    #jogadoresInputs input.visible {
      opacity: 1;
      max-height: 50px;
      margin-bottom: 15px;
    }

    #salvar {
      background-color: #fffaeb;
      color: #105652;
      width: 50px;
      height: 30px;
    }

    #salvar:hover {
      color: #76976f;
      transform: scale(1) skew(-10deg);
      transition: 0.4s all ease-in-out;
    }

    #jogadoresInputs {
      text-align: end;
    }
  </style>
</head>

<body>
  <div class="preloader" id="preloader">
    <div class="loader" id="loader"></div>
  </div>


  <form id="cadastroForm" action="gravar_cadjogadores.php" method="POST">
    <h1 style="color: #105652;">Cadastro de Jogadores</h1>
    <br>
    <div id="jogadoresInputs">
      <input type="text" name="jogador[]" placeholder="Nome do jogador 1" required class="visible" />
      <input type="text" name="jogador[]" placeholder="Nome do jogador 2" required class="visible" />
      <input type="text" name="jogador[]" placeholder="Nome do jogador 3" required class="visible" />
      <input type="text" name="jogador[]" placeholder="Nome do jogador 4" required class="visible" />
      <input type="text" name="jogador[]" placeholder="Nome do jogador 5" />
      <input type="text" name="jogador[]" placeholder="Nome do jogador 6" />

      <button type="submit" id="salvar">Salvar</button>
    </div>

    <button type="button" id="addJogadorBtn"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
        <path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z" />
      </svg></button><br /><br />
    <button id="comecarJogo" disabled style="background-color: #ccc; color: #666; cursor: not-allowed;" onclick="redirecionarPagina()">Começar jogo</button>

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
    const inputs = jogadoresInputsDiv.querySelectorAll('input[name="jogador[]"]');
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

    const jogadores = Array.from(cadastroForm.querySelectorAll('input[name="jogador[]"].visible'))
      .map(input => input.value.trim())
      .filter(nome => nome !== '');

    if (jogadores.length < minJogadores) {
      alert(`É necessário pelo menos ${minJogadores} jogadores.`);
      return;
    }

    const formData = new FormData();
    jogadores.forEach(j => formData.append('jogador[]', j));

    fetch('gravar_cadjogadores.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.text()) // converte o Response para texto
      .then(data => {
        console.log('Resposta do servidor:', data);

        if (data.includes('sucesso')) { // verifica se deu certo
          const btnComecar = document.getElementById('comecarJogo');
          btnComecar.disabled = false;
          btnComecar.style.backgroundColor = '#244937'; // sua cor original
          btnComecar.style.color = 'white'; // texto visível
          btnComecar.style.cursor = 'pointer';
        }
        alert(data); // aqui sim mostra o texto que o PHP retornou
        console.log('Resposta do servidor:', data);
      })
      .catch(error => {
        alert('Erro ao salvar jogadores.');
        console.error('Erro:', error);
      });

  });

  const inputs = document.querySelectorAll('input');

  inputs.forEach(input => {
    input.addEventListener('input', () => {
      if (input.value.trim() !== '') {
        input.classList.add('filled'); // adiciona sombra se tiver texto
      } else {
        input.classList.remove('filled'); // remove sombra se apagou texto
      }
    });
  });

  function redirecionarPagina() {
    window.location.href = "ordemdejogar.php";
  }
</script>

</html>