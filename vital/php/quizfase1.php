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
        <button onclick="window.location.href='dadofase1.php'">Voltar ao dado</button>
        <div id="resultado"></div>
    </div>

    <script>
        const quiz = [{
                pergunta: "Como saber se tem água por perto na floresta?",
                opcoes: ["Barulhos de animais e cheiro forte", "Som do vento e voo de aves ao amanhecer", "Árvore caída e folhas secas", "Silêncio e calor intenso"],
                correta: 1
            },
            {
                pergunta: "O que usar para montar um filtro de água simples?",
                opcoes: ["Areia, folhas e galhos", "Carvão, pedras pequenas e areia limpa", "Terra, musgo e folhas", "Frutas, gravetos e argila"],
                correta: 1
            },
            {
                pergunta: "O que fazer com a água filtrada antes de beber?",
                opcoes: ["Congelar", "Deixar descansar", "Ferver", "Coar com folhas"],
                correta: 2
            },
            {
                pergunta: "Como saber se um fruto ou raiz pode ser comido?",
                opcoes: ["Se brilhar ao sol", "Se estiver no chão", "Se tiver cor forte e cheiro doce", "Se estiver comido por insetos"],
                correta: 2
            },
            {
                pergunta: "Por que comer só um pedacinho de alimento novo?",
                opcoes: ["Para economizar", "Para ver se é gostoso", "Para não acabar tudo", "Para evitar intoxicação"],
                correta: 3
            },
            {
                pergunta: "O que usar para fazer uma vara de pesca improvisada?",
                opcoes: ["Pedra, cipó e folha", "Galho longo, fibras de árvore e anzol de espinho", "Bambu, seiva e folha de bananeira", "Casca de coco, musgo e cipó"],
                correta: 1
            },
            {
                pergunta: "Para que serve a armadilha de buraco?",
                opcoes: ["Pegar água", "Armazenar comida", "Pegar animais", "Dormir seguro"],
                correta: 2
            },
            {
                pergunta: "Qual madeira é boa para fazer fogo?",
                opcoes: ["Úmida e coberta de musgo", "Verde e pesada", "Seca e leve, como bambu ou pinheiro", "Madeira molhada de rio"],
                correta: 2
            },
            {
                pergunta: "Como montar um abrigo simples do tipo “A”?",
                opcoes: ["Fazer buraco no chão", "Usar galhos apoiados entre duas árvores", "Pendurar um pano numa árvore", "Dormir embaixo de uma pedra"],
                correta: 1
            },
            {
                pergunta: "Como fazer uma lâmina primitiva?",
                opcoes: ["Com folha e graveto", "Com pedra afiada presa em madeira", "Com cipó trançado", "Com espinhos"],
                correta: 1
            },
            {
                pergunta: "Como endurecer a ponta de uma lança artesanal?",
                opcoes: ["Colocar na água", "Envolver em barro", "Girar devagar no fogo", "Passar em pedra"],
                correta: 2
            },
            {
                pergunta: "Como saber se há javalis por perto?",
                opcoes: ["Grunhidos e cheiro forte", "Som de folhas secas", "Galhos quebrados", "Voo de pássaros"],
                correta: 0
            },
            {
                pergunta: "Como pedir ajuda na floresta?",
                opcoes: ["Andar o tempo todo", "Acender fogueira, usar espelhos e fazer sinais como “SOS”", "Gritar por horas", "Escrever em árvores"],
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
                
                // AVANÇA AUTOMATICAMENTE APÓS 1 SEGUNDO SE ACERTAR
                setTimeout(() => {
                    indiceAtual++;
                    if (indiceAtual < quiz.length) {
                        carregarPergunta();
                    } else {
                        // Quiz completo
                        document.getElementById("form-opcoes").innerHTML = "";
                        document.getElementById("pergunta").innerText = "";
                        document.getElementById("ver").style.display = "none";
                        document.getElementById("proxima").style.display = "none";
                        document.getElementById("resultado").innerText = `Você acertou ${acertos} de ${quiz.length} perguntas!`;
                    }
                }, 1000);
                
            } else {
                document.getElementById(`opcao-${valor}`).classList.add("errada");
                document.getElementById(`opcao-${correta}`).classList.add("certa");
                
                // BLOQUEIA O JOGADOR (código existente)
                fetch('bloquear_jogador.php', {
                    method: 'POST',
                    body: 'jogador=' + encodeURIComponent('<?php echo $_SESSION['jogador_atual']; ?>')
                });
            }

            respondeu = true;
            document.getElementById("ver").style.display = "none";
        }



        carregarPergunta();

        function redirecionarPagina() {
            window.location.href = "dadofase1.php";
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