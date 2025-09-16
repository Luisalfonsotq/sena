<?php
function listaAprendices()
{
  require_once "../conexion/conexion.php";
  try {
    $sql = "SELECT *  FROM aprendices";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;

  } catch (PDOException $e) {
    echo "<p style='color:red;'> Error al listar los datos" . $e->getMessage() . "</p>";
    return [];
  }
}
?>