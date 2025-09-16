<?php
require_once "../conexion/conexion.php";

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM aprendices WHERE id=:id");
$stmt->execute([':id' => $id]);
$aprendiz = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $primer_apellido = $_POST['primer_apellido'];
    $segundo_apellido = $_POST['segundo_apellido'];
    $correo = $_POST['correo'];

    $foto = $_FILES['foto'];
    $nombreFoto = $aprendiz['foto']; // mantener la actual

    if (isset($foto) && $foto['error'] === UPLOAD_ERR_OK) {
        // eliminar la vieja si no es usuario.png
        if ($aprendiz['foto'] !== "usuario.png" && file_exists("../img/" . $aprendiz['foto'])) {
            unlink("../img/" . $aprendiz['foto']);
        }
        $fecha = new DateTime();
        $nombreFoto = $fecha->getTimestamp() . "_" . basename($foto['name']);
        move_uploaded_file($foto['tmp_name'], "../img/" . $nombreFoto);
    }

    $sql = "UPDATE aprendices SET 
            nombres=:nombre, primer_apellido=:primer_apellido,
            segundo_apellido=:segundo_apellido, correo=:correo, foto=:foto
            WHERE id=:id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':nombre' => $nombre,
        ':primer_apellido' => $primer_apellido,
        ':segundo_apellido' => $segundo_apellido,
        ':correo' => $correo,
        ':foto' => $nombreFoto,
        ':id' => $id
    ]);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Aprendiz</title>
  <link rel="stylesheet" href="../css/bootstrap.css">
</head>
<body>
<div class="container mt-4">
  <h2>Editar Aprendiz</h2>
  <form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
      <label>Nombres</label>
      <input type="text" name="nombre" class="form-control" value="<?= $aprendiz['nombres'] ?>" required>
    </div>
    <div class="mb-3">
      <label>Primer apellido</label>
      <input type="text" name="primer_apellido" class="form-control" value="<?= $aprendiz['primer_apellido'] ?>" required>
    </div>
    <div class="mb-3">
      <label>Segundo apellido</label>
      <input type="text" name="segundo_apellido" class="form-control" value="<?= $aprendiz['segundo_apellido'] ?>">
    </div>
    <div class="mb-3">
      <label>Correo</label>
      <input type="email" name="correo" class="form-control" value="<?= $aprendiz['correo'] ?>" required>
    </div>
    <div class="mb-3">
      <label>Foto actual</label><br>
      <img src="../img/<?= $aprendiz['foto'] ?>" width="80"><br><br>
      <input type="file" name="foto" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Guardar cambios</button>
  </form>
</div>
</body>
</html>
