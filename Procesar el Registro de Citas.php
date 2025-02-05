<?php
$host = 'localhost';
$db = 'issste_citas';
$user = 'root';
$pass = ''; // Ajusta la contraseña según tu configuración

// Conectar a la base de datos
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("No se pudo conectar a la base de datos: " . $e->getMessage());
}

// Función para contar las citas registradas en el día
function contarCitas() {
    global $pdo;
    $fecha = date('Y-m-d');
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM citas WHERE fecha_cita = :fecha");
    $stmt->execute(['fecha' => $fecha]);
    return $stmt->fetchColumn();
}

// Validación de las citas disponibles
$citasDisponibles = 15 - contarCitas();

// Si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($citasDisponibles > 0) {
        // Recibir datos del formulario
        $nombre_completo = $_POST['nombre_completo'];
        $whatsapp = $_POST['whatsapp'];
        $fecha_cita = $_POST['fecha_cita'];
        $hora_cita = $_POST['hora_cita'];

        // Subir la foto del carnet
        $foto_carnet = $_FILES['foto_carnet']['name'];
        move_uploaded_file($_FILES['foto_carnet']['tmp_name'], "uploads/$foto_carnet");

        // Insertar los datos en la base de datos
        $stmt = $pdo->prepare("INSERT INTO citas (id_carnet, foto_carnet, fecha_cita, hora_cita) VALUES (?, ?, ?, ?)");
        $stmt->execute([$whatsapp, $foto_carnet, $fecha_cita, $hora_cita]);

        // Reducir la cantidad de citas disponibles
        $citasDisponibles--;
        echo "Cita registrada exitosamente!";
    } else {
        echo "No quedan fichas disponibles. Intenta nuevamente mañana.";
    }
}

// Función para generar el reporte
function generarReporte() {
    global $pdo;
    $fecha = date('Y-m-d');
    $stmt = $pdo->prepare("SELECT * FROM citas WHERE fecha_cita = :fecha");
    $stmt->execute(['fecha' => $fecha]);
    $citas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Crear el archivo Excel
    $filename = "reporte_citas_$fecha.xlsx";
    // Utiliza una librería como PHPExcel para generar el archivo Excel
    // Luego envía el reporte por WhatsApp usando la API correspondiente
}
?>
