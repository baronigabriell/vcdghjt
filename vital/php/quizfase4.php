<?php
session_start();

// Avança a pergunta automaticamente toda vez que entrar na página
if (!isset($_SESSION['pergunta_atual'])) {
    $_SESSION['pergunta_atual'] = 0;
} else {
    $_SESSION['pergunta_atual']++;
    if ($_SESSION['pergunta_atual'] >= 13) {
        $_SESSION['pergunta_atual'] = 0; // Reinicia se acabaram as perguntas
    }
}

?>

<script>
    // No carregamento da página, use o índice da sessão
    let indiceAtual = <?php echo $_SESSION['pergunta_atual']; ?>;
</script>
<head>
    <meta charset="UTF-8">
    <title>Quiz com Avaliação</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <style>
        body {
            background-image: url(../img/fundo.png);
            background-size: 100vw 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 90vh;
        }

        .quiz-container {
            background: #fffaeb;
            border-radius: 12px;
            max-width: 600px;
            width: 100%;
            font-family: outfit;
            /* padding: 30px; ← Tira isso */
            overflow: hidden;
            /* Garante que bordas arredondadas fiquem certinhas */
        }

        .pergunta {
            font-size: 20px;
            margin-bottom: 10px;
            padding: 30px 30px 0 30px;
            /* Adiciona padding individual */
        }

        .opcao {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
            padding: 15px 30px;
            border-radius: 0;
            /* Tira arredondamento se quiser colado */
            transition: background-color 0.3s;
            width: 100%;
            box-sizing: border-box;
        }


        .opcao input {
            margin-right: 10px;
        }

        .certa {
            background-color: rgb(137, 241, 184);
            width: 100%;
        }

        .errada {
            background-color: rgb(212, 91, 91);
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
            margin-left: 6%;
            margin-top: 10px;
            margin-bottom: 10px;
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


        #resultado {
            font-size: 20px;
            margin-top: 20px;
            font-weight: bold;
        }

        .opcao input[type="radio"] {
            appearance: none;
            -webkit-appearance: none;
            width: 20px;
            height: 20px;
            border: 2px solid #3ea071;
            border-radius: 50%;
            outline: none;
            cursor: pointer;
            transition: border-color 0.3s ease;
            position: relative;
            background-color: transparent;
            /* fundo transparente para herdar o container */
        }

        .opcao input[type="radio"]::before {
            content: "";
            position: absolute;
            /* espaço interno para criar o pontinho */
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: transparent;
            /* transparente quando não selecionado */
            transition: background-color 0.3s ease;
        }

        .opcao input[type="radio"]:checked {
            border-color: #3ea071;
        }

        .opcao input[type="radio"]:checked::before {
            background-color: #3ea071;
            /* pontinho verde quando selecionado */
        }
    </style>
</head>

<body>
    <div class="quiz-container">
        <div class="pergunta" id="pergunta"></div>
        <form id="form-opcoes"></form>
        <div>
            <button id="ver" onclick="verResposta()">Ver resposta</button>
            <button id="proxima" onclick="proximaPergunta()" style="display: none;">Próxima</button>
        </div>
        <button onclick="window.location.href='dadofase4.php'">Voltar ao dado</button>
        <div id="resultado"></div>
    </div>

    <script>
        const quiz = [{
                pergunta: "Antes de usar um barco abandonado para fugir da floresta, o que é essencial verificar?",
                opcoes: [
                    "Se o barco tem remos e está estável na água",
                    "Se há peixes perto do barco",
                    "Se a margem do rio é rasa",
                    "Se o barco tem cobertura contra chuva"
                ],
                correta: 0
            },
            {
                pergunta: "Para fazer fumaça branca visível a distância, o que deve ser queimado?",
                opcoes: [
                    "Galhos secos",
                    "Folhas verdes, musgo úmido ou gramíneas",
                    "Papel e plástico",
                    "Madeira velha"
                ],
                correta: 1
            },
            {
                pergunta: "Como usar um espelho para sinalizar resgate?",
                opcoes: [
                    "Apontando para o chão e movimentando-o lentamente",
                    "Direcionando flashes solares para aeronaves ou montanhas próximas com movimentos de vai-e-volta",
                    "Jogando-o no chão para refletir a luz do sol",
                    "Usando o espelho para se olhar e identificar pontos de referência"
                ],
                correta: 1
            },
            {
                pergunta: "Qual é a melhor forma de sinalizar um pedido de socorro no chão?",
                opcoes: [
                    "Fazer letras pequenas com galhos",
                    "Formar letras grandes (3m ou mais), como “SOS”, com pedras ou folhas em área aberta",
                    "Fazer desenhos com terra escura",
                    "Colocar roupas no chão"
                ],
                correta: 1
            },
            {
                pergunta: "Qual som é mais eficiente para chamar a atenção de equipes de resgate?",
                opcoes: [
                    "Batidas regulares com pedras, assobios ou estalos alternados com pausas",
                    "Gritos contínuos e altos",
                    "Música de rádio improvisada",
                    "Sons aleatórios sem ritmo"
                ],
                correta: 0
            },
            {
                pergunta: "Para que serve amarrar tecidos coloridos ou roupas em árvores altas?",
                opcoes: [
                    "Para secar roupas",
                    "Para servir como pontos visuais que ajudam equipes de resgate a localizar você",
                    "Para assustar animais",
                    "Para marcar território"
                ],
                correta: 1
            },
            {
                pergunta: "Por que é importante marcar o caminho com pedras ou galhos cruzados?",
                opcoes: [
                    "Para se proteger de animais",
                    "Para facilitar o retorno ou a localização por equipes de resgate",
                    "Para deixar mensagem para outros sobreviventes",
                    "Para criar um mapa da floresta"
                ],
                correta: 1
            },
            {
                pergunta: "Como poças e superfícies úmidas podem ajudar na sinalização?",
                opcoes: [
                    "Refletindo luz solar para chamar atenção",
                    "Servindo de água potável",
                    "Escondendo pegadas",
                    "Atraindo animais"
                ],
                correta: 0
            },
            {
                pergunta: "Qual a vantagem de fazer uma fogueira noturna em uma área segura?",
                opcoes: [
                    "Aquecer para dormir melhor",
                    "Tornar-se visível a equipes de resgate a longa distância",
                    "Cozinhar alimentos",
                    "Afastar insetos"
                ],
                correta: 1
            },
            {
                pergunta: "Por que subir em árvores altas pode ajudar na fuga?",
                opcoes: [
                    "Para colher frutas",
                    "Para ter uma visão panorâmica e identificar rios, clareiras ou fumaça de outros sobreviventes",
                    "Para fugir de animais no chão",
                    "Para descansar"
                ],
                correta: 1
            },
            {
                pergunta: "Quando é mais eficiente usar assobios para pedir ajuda?",
                opcoes: [
                    "Durante a noite, em silêncio total",
                    "De manhã e no entardecer, em séries de 3 sons com intervalos regulares",
                    "A qualquer hora, de forma contínua",
                    "Somente em clareiras"
                ],
                correta: 1
            },
            {
                pergunta: "Como a leitura do terreno pode ajudar a escapar da floresta?",
                opcoes: [
                    "Seguindo sempre as árvores maiores",
                    "Identificando montanhas, cursos d’água e folhagens para encontrar direção a vilarejos ou rios",
                    "Ignorando sons da floresta",
                    "Seguindo o vento"
                ],
                correta: 1
            },
            {
                pergunta: "O que indica um bom lugar para formar sinais de resgate no chão?",
                opcoes: [
                    "Área densa e com sombra",
                    "Área aberta com alto contraste visual, como clareiras ou praias",
                    "Próximo a rios estreitos",
                    "Dentro de cabanas"
                ],
                correta: 1
            }
        ];



        let acertos = 0;
        let respondeu = false;

        function carregarPergunta() {
            respondeu = false;
            document.getElementById("ver").style.display = "inline-block";
            document.getElementById("proxima").style.display = "none";

            const q = quiz[indiceAtual];
            document.getElementById("pergunta").innerText = q.pergunta;

            const form = document.getElementById("form-opcoes");
            form.innerHTML = "";

            q.opcoes.forEach((opcao, i) => {
                const div = document.createElement("div");
                div.classList.add("opcao");
                div.setAttribute("id", `opcao-${i}`);

                const input = document.createElement("input");
                input.type = "radio";
                input.name = "resposta";
                input.value = i;

                const label = document.createElement("label");
                label.innerText = opcao;

                div.appendChild(input);
                div.appendChild(label);
                form.appendChild(div);
            });
        }

        function verResposta() {
            if (respondeu) return;

            const selecionada = document.querySelector("input[name='resposta']:checked");
            if (!selecionada) {
                alert("Selecione uma alternativa antes de ver a resposta.");
                return;
            }

            const valor = parseInt(selecionada.value);
            const correta = quiz[indiceAtual].correta;

            if (valor === correta) {
                document.getElementById(`opcao-${valor}`).classList.add("certa");
                acertos++;
            } else {
                document.getElementById(`opcao-${valor}`).classList.add("errada");
                document.getElementById(`opcao-${correta}`).classList.add("certa");

                // Marca que o jogador errou (para bloquear na próxima rodada)
                fetch('bloquear_jogador.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `jogador=<?php echo urlencode($_SESSION['jogador_atual']); ?>`
                });
            }

            respondeu = true;
            document.getElementById("ver").style.display = "none";
            document.getElementById("proxima").style.display = "inline-block";

            if (valor !== correta) {
                // BLOQUEIA O JOGADOR
                fetch('bloquear_jogador.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: 'jogador=' + encodeURIComponent('<?php echo $_SESSION['jogador_atual']; ?>')
                    })
                    .then(response => response.text())
                    .then(data => {
                        if (data === 'OK') {
                            console.log('Jogador bloqueado com sucesso');
                        } else {
                            console.error('Falha ao bloquear jogador');
                        }
                    });
            }
        }


        function proximaPergunta() {
            indiceAtual++;
            if (indiceAtual < quiz.length) {
                carregarPergunta();
            } else {
                document.getElementById("form-opcoes").innerHTML = "";
                document.getElementById("pergunta").innerText = "";
                document.getElementById("ver").style.display = "none";
                document.getElementById("proxima").style.display = "none";
                document.getElementById("resultado").innerText = `Você acertou ${acertos} de ${quiz.length} perguntas!`;
            }
        }

        carregarPergunta();

        function redirecionarPagina() {
            window.location.href = "dadofase4.php";
        }
    </script>
    <?php
    include 'conecta.php';

    if (isset($_SESSION['indice_vez'])) {
        // Recupera dados atuais
        $query = "SELECT jogadores_id, ordem_jogo, indice_vez FROM jogadores ORDER BY jogadores_id DESC LIMIT 1";
        $result = mysqli_query($conexao, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $jogadores_id = $row['jogadores_id'];
            $jogadores = json_decode($row['ordem_jogo'], true);
            $indice_vez = $row['indice_vez'];

            // Avança o índice (apenas +1; skip será tratado no dadofase1.php)
            $novo_indice = ($indice_vez + 1) % count($jogadores);

            // Atualiza no banco e sessão
            mysqli_query($conexao, "UPDATE jogadores SET indice_vez = $novo_indice WHERE jogadores_id = $jogadores_id");
            $_SESSION['indice_vez'] = $novo_indice;
        }
    }
    ?>

</body>

</html>