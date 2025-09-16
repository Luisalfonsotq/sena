<?php
require_once "../conexion/conexion.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // obtener la foto
    $stmt = $conn->prepare("SELECT foto FROM aprendices WHERE id=:id");
    $stmt->execute([':id' => $id]);
    $foto = $stmt->fetchColumn();

    // eliminar archivo si no es usuario.png
    if ($foto && $foto !== "usuario.png" && file_exists("../img/" . $foto)) {
        unlink("../img/" . $foto);
    }

    // eliminar registro
    $stmt = $conn->prepare("DELETE FROM aprendices WHERE id=:id");
    $stmt->execute([':id' => $id]);

    header("Location: index.php");
    exit;
}
?>
