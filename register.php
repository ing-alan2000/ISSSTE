<?php
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_carnet = $_POST['id_carnet'];
    $nombre_completo = $_POST['nombre_completo'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $password = $_POST['password'];

    // Verificar si el correo ya está registrado
    $sql = "SELECT * FROM usuarios WHERE correo = '$correo'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<script>alert('El correo ya está registrado');</script>";
    } else {
        // Insertar el nuevo usuario en la base de datos
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuarios (id_carnet, nombre_completo, telefono, correo, password) 
                VALUES ('$id_carnet', '$nombre_completo', '$telefono', '$correo', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Registro exitoso. Inicia sesión ahora'); window.location.href='index.html';</script>";
        } else {
            echo "<script>alert('Error al registrar');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <div class="logo-circle">
                <img src="img/ISSSTE1.webp" alt="Logo">
            </div>
            <h2>Registro de usuario</h2>
            <form method="POST">
                <input type="text" name="id_carnet" placeholder="ID Carnet" required>
                <input type="text" name="nombre_completo" placeholder="Nombre completo" required>
                <input type="text" name="telefono" placeholder="Teléfono" required>
                <input type="email" name="correo" placeholder="Correo electrónico" required>
                <input type="password" name="password" placeholder="Contraseña" required>
                <button type="submit">Registrarse</button>
            </form>
            <p>¿Ya tienes cuenta? <a href="index.html">Inicia sesión</a></p>
        </div>
    </div>
</body>
</html>
