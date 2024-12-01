<?php
include 'conexion.php'; // Incluir el archivo de conexión

if (isset($_GET['curso_id'])) {
    $curso_id = $_GET['curso_id']; // Obtener el ID del curso desde la URL

    // Obtener la información del curso
    $sql = "SELECT * FROM cursos WHERE id = :curso_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':curso_id', $curso_id);
    $stmt->execute();
    $curso = $stmt->fetch();
} else {
    echo "Curso no encontrado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscripción al Curso</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Inscripción al Curso: <?php echo $curso['nombre']; ?></h1>
        <form action="procesar_inscripcion.php" method="POST">
            <input type="hidden" name="curso_id" value="<?php echo $curso['id']; ?>">

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="email">Correo Electrónico:</label>
            <input type="email" id="email" name="email" required>

            <button type="submit">Inscribirse</button>
        </form>
    </div>
</body>
</html>
