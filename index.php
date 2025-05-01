<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Extensao - Jogo</title>

    <!-- bootstrap do hugasso -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <!--css-->
    <style>
        @charset "UTF-8";

        body {
            background: linear-gradient(to bottom right, #1e1e60, #4e54c8, #8f94fb);
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: cover;
            min-height: 100vh;
        }

        #titulo {
            text-align: center;
            font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
            font-weight: 100;
            font-size: 2em;
            background: linear-gradient(to right, #242983, #333781);
            color: aliceblue;
            padding: 3px;
            box-shadow: 3px 3px 2px rgba(0, 0, 0, 0.249);
            border-radius: 20px;
            max-width: 900px;
            margin: auto;
            text-shadow: 2px 2px 1px rgb(0, 0, 0);
        }

        .card {
            height: 100vh;
            border-radius: 7px;
            border: 1px solid black;
        }

        .centralizar {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        #pergunta {
            margin: auto;
            text-align: center;
            border: 1px solid black;
            border-radius: 10px;
            height: 80px;
            margin-top: 25px;
            color: black;
            max-width: 400px;
        }

        #resposta {
            max-width: 350px;
            margin: auto;
        }

        .larg {
            min-width: 400px;

        }

        #cet {
            margin: auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <!--materia-->
                <div id="titulo">QuickMath</div>
                <!--perguntas-->
                
                <div id="pergunta">
                    <div id="resposta">
                        eadsadsasdasdasseadsadsasdasdass
                    </div>
                </div>
                <!--bottoes-->
                <div id="cet">
                    <div class="d-grid gap-2 col-8 mx-auto centralizar" ;>
                        <button class="btn btn-info" type="button">1</button>
                        <button class="btn btn-info" type="button">2 </button>
                        <button class="btn btn-info" type="button">3</button>
                        <button class="btn btn-info" type="button">4 </button>
                    </div>
                </div>
                <footer class="fixed-bottom bg-light text-center p-3">
                    <button class="btn btn-warning bi bi-lightbulb"></button>
                    <button class="btn btn-danger bi bi-fire"></button>
                </footer>
            </div>
        </div>
    </div>

    <script src="includes/js/script.js"></script>
    <!--bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- bootstrap do hugasso -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
        crossorigin="anonymous"></script>
</body>

</html>