<?php
// Iniciar la sesión
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['email'])) {
    header("Location: index.html");
    exit();
}

// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "roboreport");

if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $descripcion = $_POST['descripcion'];
    $usuario = $_SESSION['email']; // Usamos el email del usuario que inició sesión

    // Insertar el reporte en la base de datos
    $insertQuery = "INSERT INTO reportes (descripcion, usuario) VALUES (?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("ss", $descripcion, $usuario);

    if ($stmt->execute()) {
        echo "Reporte guardado con éxito.";
    } else {
        echo "Error al guardar el reporte: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();

