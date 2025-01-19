<?php
$idcliente = isset($_GET['idcliente']) ? $_GET['idcliente'] : '';
$idcotizacion = isset($_GET['idcotizacion']) ? $_GET['idcotizacion'] : '';
$maquinarias = isset($_GET['maquinarias']) ? unserialize(urldecode($_GET['maquinarias'])) : [];
$lugares = isset($_GET['lugares']) ? unserialize(urldecode($_GET['lugares'])) : [];
$cliente = isset($_GET['cliente']) ? unserialize(urldecode($_GET['cliente'])) : null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de Cotización</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            background-color: #fff;
            max-width: 1200px;
            margin: 0 auto;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            padding: 20px;
            background-color: #f3f4f6;
            border-bottom: 2px solid #e2e8f0;
            text-align: center;
        }

        .header h3 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
            color: #1f2937;
        }

        .content {
            padding: 20px;
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .field {
            display: flex;
            flex-direction: column;
        }

        .field label {
            font-size: 14px;
            font-weight: 500;
            color: #4b5563;
            margin-bottom: 5px;
        }

        .field input,
        .field select {
            height: 40px;
            padding: 0 10px;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            background-color: #f3f4f6;
            font-size: 14px;
        }

        .field input:disabled {
            background-color: #e5e7eb;
            color: #6b7280;
        }

        .divider {
            height: 1px;
            width: 100%;
            background-color: #e2e8f0;
            margin: 20px 0;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 40px;
            background-color: #eab308;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 0 20px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #d97706;
        }

        .result {
            font-weight: bold;
            color: #000;
        }

        .field input[type="text"] {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h3>Detalles de Cotización</h3>
    </div>
    <div class="content">
        <form id="formulario" action="../../CONTROLLER/CoticeController.php" method="post">
            <div class="grid">
                <div class="field">
                    <label for="clientId">ID Cliente</label>
                    <input id="clientId" type="text" disabled value="<?= htmlspecialchars($idcliente) ?>">
                    <input type="hidden" name="idcliente" value="<?= htmlspecialchars($idcliente) ?>">
                </div>
                <div class="field">
                    <label for="quoteId">ID Cotización</label>
                    <input id="quoteId" type="text" disabled value="<?= htmlspecialchars($idcotizacion) ?>">
                    <input type="hidden" name="idcotizacion" value="<?= htmlspecialchars($idcotizacion) ?>">
                </div>
            </div>
            <div class="grid">
                <div class="field">
                    <label for="firstName">Nombre</label>
                    <input id="firstName" type="text" disabled value="<?= $cliente ? htmlspecialchars($cliente['nombre']) : 'N/A' ?>">
                </div>
                <div class="field">
                    <label for="lastName">Apellido</label>
                    <input id="lastName" type="text" disabled value="<?= $cliente ? htmlspecialchars($cliente['apellido']) : 'N/A' ?>">
                </div>
            </div>
            <div class="field">
                <label for="email">Correo electrónico</label>
                <input id="email" type="text" disabled value="<?= $cliente ? htmlspecialchars($cliente['correo']) : 'N/A' ?>">
            </div>
            <div class="divider"></div>
            <div class="grid">
                <div class="field">
                    <label for="idmaquinaria">Maquinarias</label>
                    <select name="idmaquinaria" id="idmaquinaria">
                        <?php if (!empty($maquinarias)): ?>
                            <?php foreach ($maquinarias as $maquinaria): ?>
                                <option value="<?= htmlspecialchars($maquinaria['idmaquinaria']) ?>" data-costoh="<?= htmlspecialchars($maquinaria['costoh']) ?>">
                                    <?= htmlspecialchars($maquinaria['nombre']) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option>No hay maquinarias disponibles.</option>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="field">
                    <label for="idlugar">Lugares</label>
                    <select name="idlugar" id="idlugar">
                        <?php if (!empty($lugares)): ?>
                            <?php foreach ($lugares as $lugar): ?>
                                <option value="<?= htmlspecialchars($lugar['idlugar']) ?>"><?= htmlspecialchars($lugar['ciudad']) ?></option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option>No hay lugares disponibles.</option>
                        <?php endif; ?>
                    </select>
                </div>
            </div>
            <div class="field">
                <label>Indique el número de horas a trabajar:</label>
                <input type="text" id="numero" name="numero" placeholder="Ingrese un n�mero" inputmode="numeric" pattern="\d*" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                <input type="hidden" name="total" id="total"> <!-- Campo oculto para enviar el total -->
                <input type="hidden" name="tiempo" id="tiempo"> <!-- Campo oculto para enviar el tiempo -->
            </div>
            <button class="button" type="button" id="enviarBtn" onclick="enviarFormulario()">Enviar Selección</button>
        </form>
        <div class="divider"></div>
        <div class="grid">
            <div class="field">
                <label for="estimatedCost">Costo estimado a pagar</label>
                <input id="estimatedCost" type="text" disabled value="">
            </div>
            <div class="field">
                <label for="estimatedDays">Tiempo estimado en días</label>
                <input id="estimatedDays" type="text" disabled value="">
            </div>
        </div>
    </div>
</div>

<script>
    function calcularResultado() {
        var selectMaquinaria = document.getElementById("idmaquinaria");
        var costoh = selectMaquinaria.options[selectMaquinaria.selectedIndex].getAttribute("data-costoh");
        var numero = document.getElementById("numero").value;
        var resultado = costoh * numero;
        var tiempoDias = numero / 8;
        document.getElementById("estimatedCost").value = 'S/. ' + resultado.toFixed(2);
        document.getElementById("estimatedDays").value = tiempoDias.toFixed(2) + ' días';
        document.getElementById("total").value = resultado;
        document.getElementById("tiempo").value = tiempoDias.toFixed(2);
    }

    function enviarFormulario() {
        document.getElementById("enviarBtn").disabled = true;

        calcularResultado();

        document.getElementById("formulario").submit();

        setTimeout(function() {
            document.getElementById("enviarBtn").disabled = false;
            document.getElementById("formulario").submit();
        }, 1000);
    }

    document.getElementById("idmaquinaria").addEventListener("change", calcularResultado);
    document.getElementById("numero").addEventListener("input", calcularResultado);
</script>

</body>
</html>
