<?php
require_once "../conexion/conexion.php";

if (isset($_POST['insertar'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $primer_apellido = $_POST['primer_apellido'];
    $segundo_apellido = $_POST['segundo_apellido'];
    $correo = $_POST['correo'];

    // Foto
    $foto = $_FILES['foto'];
    $nombreFoto = "usuario.png";
    if (isset($foto) && $foto['error'] === UPLOAD_ERR_OK) {
        $fecha = new DateTime();
        $nombreFoto = $fecha->getTimestamp() . "_" . basename($foto['name']);
        move_uploaded_file($foto['tmp_name'], "../img/" . $nombreFoto);
    }

    $sql = "INSERT INTO aprendices (id, nombres, primer_apellido, segundo_apellido, correo, foto)
            VALUES (:id, :nombre, :primer_apellido, :segundo_apellido, :correo, :foto)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':id' => $id,
        ':nombre' => $nombre,
        ':primer_apellido' => $primer_apellido,
        ':segundo_apellido' => $segundo_apellido,
        ':correo' => $correo,
        ':foto' => $nombreFoto
    ]);

    header("Location: index.php");
    exit;
}
?>
