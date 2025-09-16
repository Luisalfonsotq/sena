<?php
require_once "../conexion/conexion.php"; // archivo de conexión con PDO

if (isset($_POST['insertar'])) {
  $id = $_POST['id'];
  $nombre = $_POST['nombre'];
  $primer_apellido = $_POST['primer_apellido'];
  $segundo_apellido = $_POST['segundo_apellido'];
  $correo = $_POST['correo'];
  $foto = $_FILES['foto'];
  $fecha = new DateTime();
  $nombreFoto = ($foto !="") ? $fecha->getTimestamp() . "_" . $foto["name"] : "usuario.png";
  $tmpNombreFoto = $foto["foto"]["tmp_name"];

  if($tmpNombreFoto != ""){
    move_uploaded_file($tmpNombreFoto, "../img/" . $nombreFoto);
    // Eliminar la foto anterior de la carpeta ../img/
    $sentencia = $pdo->prepare("SELECT foto FROM aprendices WHERE id=:id");
    $sentencia->bindParam(':id', $id);
    $sentecia->execute();
  };
  $rutaDestino = "../img/" .basename($foto['name']);

  if(move_uploaded_file($foto['tmp_name'], $rutaDestino)){
  try {
    //Ajusta el nombre de la tabla (ej: aprendices)
    $sql = "INSERT INTO aprendices (id, nombres, primer_apellido, segundo_apellido, correo, foto) 
                VALUES (:id, :nombre, :primer_apellido, :segundo_apellido, :correo, :foto)";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
      ':id' => $id,
      ':nombre' => $nombre,
      ':primer_apellido' => $primer_apellido,
      ':segundo_apellido' => $segundo_apellido,
      ':correo' => $correo,
      ':foto' => $foto
    ]);

    echo "<p style='color:green;'>✅ Registro insertado correctamente</p>";
    echo "<a href='./index.php'>Volver al formulario</a>";
  } catch (PDOException $e) {
    echo "<p style='color:red;'>❌ Error al insertar: " . $e->getMessage() . "</p>";
  }
  } else {
    echo "<p style='color:red;'> Error al subir la foto</p>";
  }
}
?>