<?php
// Mostrar errores de PHP
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); // Mostrar errores detallados

// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "roboreport");

// Verificar la conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email-registro'];
    $password = $_POST['password-registro'];

    // Verificar si el correo ya está registrado
    $checkEmailQuery = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($checkEmailQuery);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "El correo electrónico ya está registrado.";
    } else {
        // Insertar el nuevo usuario
        $hashed_password = password_hash($password, PASSWORD_BCRYPT); // Encriptar la contraseña
        $insertQuery = "INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("sss", $nombre, $email, $hashed_password);

        if ($stmt->execute()) {
            echo "Registro exitoso.";
        } else {
            echo "Error al registrar: " . $stmt->error;
        }
    }

    $stmt->close();
}

$conn->close();

