<?php
include 'conexion.php'; // Incluir la conexión a la base de datos

// Verificar si se han enviado los datos necesarios
if (isset($_POST['curso_id'], $_POST['nombre'], $_POST['email'])) {
    $curso_id = $_POST['curso_id'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];

    // Validar datos (puedes ampliar estas validaciones según tus necesidades)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Correo electrónico no válido.";
        exit;
    }

    // Insertar los datos en la tabla `inscritos`
    $sql = "INSERT INTO inscritos (nombre, email, curso_id) VALUES (:nombre, :email, :curso_id)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':curso_id', $curso_id);

    try {
        $stmt->execute();
        echo "Inscripción exitosa.";
    } catch (PDOException $e) {
        echo "Error al inscribirse: " . $e->getMessage();
        exit;
    }
} else {
    echo "Datos incompletos.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscripción Completa</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>¡Gracias por inscribirte!</h1>
        <p>Te has inscrito correctamente al curso.</p>

        <!-- Botón para regresar a la lista de cursos -->
        <div class="regresar">
            <a href="index.php">Volver a la lista de cursos</a>
        </div>
    </div>
</body>
</html>
