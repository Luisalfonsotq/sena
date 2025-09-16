<?php
require_once "../conexion/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Obtener y sanear los datos formulario
  $id = $_POST["id"];
  $nombre = $_POST["nombre"];
  $primer_apellido = $_POST["primer_apellido"];
  $segundo_apellido = $_POST["segundo_apellido"];
  $correo = $_POST["correo"];
  $foto = $_FILES['foto'];
  $rutaDestino = "../img/" .basename($foto['name']);

  try {
    // Consulta SQL para actualizar los datos
    $sql = "UPDATE aprendices
        SET nombres = :nombre,
        primer_apellido = :primer_apellido,
        segundo_apellido = :segundo_apellido,
        correo = :correo,
        foto = :foto
        WHERE id = :id";
    $stmt = $conn->prepare($sql);

    // Vincular los parámetros
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':primer_apellido', $primer_apellido);
    $stmt->bindParam(':segundo_apellido', $segundo_apellido);
    $stmt->bindParam(':correo', $correo);
    $stmt->bindParam(':foto', $foto);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Ejecutar la consulta
    $stmt->execute();

    // Redirigir de vuelta a la página principal con un mesaje de exito (ok)
    header("Location: index.php?status=update_ok");
    exit();

  } catch (PDOException $e) {
    header("Location: index.php?status=update_error&msg=" . urldecode($e->getMessage()));
    exit();
  }
} else {
  // Acceso directo a la URL no permitido
  header("Location: index.php");
  exit();
}
?>