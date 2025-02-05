<?php
session_start();
include('config.php'); // Incluir la conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE correo = '$correo'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // El usuario existe, verificar contraseña
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Iniciar sesión
            $_SESSION['id_carnet'] = $row['id_carnet'];
            header("Location: FormularioRegistroDeCitas.html"); // Redirigir al panel de usuario
        } else {
            echo "<script>alert('Contraseña incorrecta'); window.location.href = 'index.html';</script>";
        }
    } else {
        echo "<script>alert('El correo no existe');</script>";
    }
}
?>
