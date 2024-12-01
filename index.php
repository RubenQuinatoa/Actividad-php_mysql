<?php
include 'conexion.php'; // Incluir el archivo de conexión

// Consulta para obtener todos los cursos
$sql = "SELECT * FROM cursos";
$stmt = $conn->prepare($sql); // Preparar la consulta
$stmt->execute(); // Ejecutar la consulta
$cursos = $stmt->fetchAll(); // Obtener todos los resultados

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Cursos</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Bienvenido a la Plataforma de Cursos</h1>
        <p>Selecciona un curso para ver más detalles e inscribirte.</p>
        
        <!-- Mostrar los cursos desde la base de datos -->
        <div class="cursos">
            <?php
            foreach ($cursos as $curso) {
                echo "<div class='curso'>
                        <h2>{$curso['nombre']}</h2>
                        <p>{$curso['descripcion']}</p>
                        <p><strong>Cupo disponible: </strong>{$curso['cupo']}</p>
                        <a href='inscripcion.php?curso_id={$curso['id']}' class='inscribirse'>Inscribirse</a>
                      </div>";
            }
            ?>
        </div>
    </div>
</body>
</html>
