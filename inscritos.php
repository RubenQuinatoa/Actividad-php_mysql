<?php
include 'conexion.php'; // Incluir el archivo de conexión

// Verificar si se pasó un curso_id por la URL
if (isset($_GET['curso_id'])) {
    $curso_id = $_GET['curso_id']; // Obtener el ID del curso

    // Obtener el nombre del curso
    $sql = "SELECT nombre FROM cursos WHERE id = :curso_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':curso_id', $curso_id);
    $stmt->execute();
    $curso = $stmt->fetch();

    if ($curso) {
        // Obtener los inscritos para este curso
        $sql = "SELECT * FROM inscritos WHERE curso_id = :curso_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':curso_id', $curso_id);
        $stmt->execute();
        $inscritos = $stmt->fetchAll();
    } else {
        echo "Curso no encontrado.";
        exit;
    }
} else {
    echo "No se ha especificado un curso.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscritos en el Curso: <?php echo $curso['nombre']; ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Inscritos en el Curso: <?php echo $curso['nombre']; ?></h1>

        <!-- Tabla de inscritos -->
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Correo Electrónico</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($inscritos) {
                    foreach ($inscritos as $inscrito) {
                        echo "<tr>
                                <td>{$inscrito['nombre']}</td>
                                <td>{$inscrito['email']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>No hay inscritos aún.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Botón para regresar a la lista de cursos -->
        <div class="regresar">
            <a href="index.php">Regresar a la lista de cursos</a>
        </div>
    </div>
</body>
</html>

