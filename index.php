<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOSA</title>
    <link rel="icon" href="sosalogo.png" type="image/png">

    <style>
        body.loading {
            overflow: hidden;
        }

        #loading {
            position: fixed;
            z-index: 9999;
            height: 100%;
            width: 100%;
            background: #ffcb0f;
        }

        #loading-center {
            width: 100%;
            height: 100%;
            position: relative;
        }

        #loading-center-absolute {
            position: absolute;
            left: 50%;
            top: 50%;
            height: 100px;
            width: 100px;
            margin-top: -50px;
            margin-left: -50px;
        }

        .object {
            width: 10px;
            height: 10px;
            background-color: #222533;
            float: left;
            margin-right: 10px;
            margin-top: 10px;
            border-radius: 50%;
            animation: animate 2s infinite;
        }

        @keyframes animate {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.5);
            }
            100% {
                transform: scale(1);
            }
        }

        #loaded-text {
            display: none;
            text-align: center;
            font-size: 24px;
            color: #222533;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div id="loading">
        <div id="loading-center">
            <div id="loading-center-absolute">
                <div class="object"></div>
                <div class="object"></div>
                <div class="object"></div>
                <div class="object"></div>
                <div class="object"></div>
                <div class="object"></div>
                <div class="object"></div>
                <div class="object"></div>
                <div class="object"></div>
                <div class="object"></div>
            </div>
        </div>
    </div>

    <?php
        include("VIEW/header.php");
        require_once("DB/db.php");
        
        $action = isset($_GET['action']) ? $_GET['action'] : 'home';

        switch ($action) {
            case 'catalogo':
                require_once("CONTROLLER/MaquinariaController.php");
                clsMaquinaria::catalogoMaquinaria();
                break;
            case 'nosotros':
                require_once("VIEW/nosotros.php");
                break;
            case 'cotice': 
                require_once("CONTROLLER/CoticeController.php");
                break;
            case 'login': 
                require_once("login.php");
                break;
            case 'detalle-maquinaria':
                require_once("CONTROLLER/MaquinariaController.php");
                clsMaquinaria::detalleMaquinaria();
                break;
            case 'home':
            default:
                require_once("VIEW/home.php");
                break;
        }
    ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('body').addClass('loading');

            setTimeout(function() {
                $('#loading').fadeOut('slow', function() {
                    $('#loaded-text').fadeIn('slow');
                    $('body').removeClass('loading');
                });
            }, 700);
        });
    </script>
</body>
</html>
