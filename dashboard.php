<?php
// Iniciar la sesión
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['email'])) {
    // Si no hay sesión, redirigir al inicio de sesión
    header("Location: index.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Usuario - RoboReport</title>
    <link rel="stylesheet" href="estilo.css">
    <style>
        /* Estilos para el botón grande */
        .boton-rojo {
            background-color: #FF0000;
            color: white;
            padding: 20px;
            font-size: 24px;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            width: 300px;
            text-align: center;
            display: block;
            margin: 50px auto;
            transition: background-color 0.3s ease;
        }
        <button class="boton-rojo" onclick="mostrarFormulario()">¡ALERTA!</button>



        .boton-rojo:hover {
            background-color: #CC0000;
        }

        /* Estilo del formulario emergente */
        .formulario-emergente {
            display: none;
            position: fixed;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            z-index: 1000;
        }

        /* Fondo opaco para el efecto de ventana emergente */
        .fondo-opaco {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        /* Botón de cerrar en el formulario emergente */
        .cerrar-formulario {
            background-color: #FF0000;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            float: right;
        }
    </style>
    <script>
        // Mostrar el formulario emergente
        function mostrarFormulario() {
            document.getElementById('fondo-opaco').style.display = 'block';
            document.getElementById('formulario-emergente').style.display = 'block';
        }

        // Cerrar el formulario emergente
        function cerrarFormulario() {
            document.getElementById('fondo-opaco').style.display = 'none';
            document.getElementById('formulario-emergente').style.display = 'none';
        }
    </script>
</head>
<body>
    <header>
        <h1>Bienvenido al Panel de Usuario</h1>
    </header>

    <main>
        <section id="contenido-principal">
            <h2>¡Hola, <?php echo $_SESSION['nombre']; ?>!</h2>
            <p>Aquí puedes reportar un incidente.</p>

            <!-- Botón rojo grande -->
            <button class="boton-rojo" onclick="mostrarFormulario()">Reportar Incidente</button>

            <!-- Fondo opaco -->
            <div id="fondo-opaco" class="fondo-opaco"></div>

            <!-- Formulario emergente para reportar incidente -->
            <div id="formulario-emergente" class="formulario-emergente">
                <button class="cerrar-formulario" onclick="cerrarFormulario()">X</button>
                <h2>Reportar Incidente</h2>
                <form action="guardar_reporte.php" method="POST">
                    <label for="descripcion">Descripción:</label>
                    <textarea id="descripcion" name="descripcion" rows="4" cols="40" required></textarea>
                    <br><br>
                    <button type="submit">Enviar Reporte</button>
                </form>
            </div>
        </section>
    </main>
</body>
</html>

