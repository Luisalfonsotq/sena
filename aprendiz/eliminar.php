<?php
// Incluye el archivo de conexión a la base de datos
require_once "../conexion/conexion.php";

// Verifica si los datos se enviaron a través del método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Obtener y sanear el ID del aprendiz
  $id = $_POST['id'];

  try {
    // Prepara la consulta SQL para eliminar el registro
    $sql = "DELETE FROM aprendices WHERE id = :id";

    $stmt = $conn->prepare($sql);

    // Vincula el parámetro para prevenir inyección SQL
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Ejecuta la consulta
    $stmt->execute();

    // Redirige al usuario de vuelta a la página principal con un mensaje de éxito
    header("Location: index.php?status=delete_ok");
    exit();

  } catch (PDOException $e) {
    // En caso de error, puedes redirigir con un mensaje de error
    header("Location: index.php?status=delete_error&msg=" . urlencode($e->getMessage()));
    exit();
  }
} else {
  // Si la solicitud no es POST, no se permite el acceso directo
  header("Location: index.php");
  exit();
}
?>