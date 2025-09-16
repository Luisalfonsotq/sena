<?php
$servername = "127.0.0.1";
$dbname = "sena";
$username = "root";
$password = "";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // echo "Conexión exitosa"; // solo para pruebas
} catch(PDOException $e) {
  die("Error en la conexión: " . $e->getMessage());
}
?>
