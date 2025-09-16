<?php require_once "../conexion/conexion.php"; ?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>CRUD Aprendices</title>
  <link rel="stylesheet" href="../css/bootstrap.css">
</head>

<body>
  <div>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>">Pagina principal</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="nosotros.htlm">Nosotros</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Features</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Pricing</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled">Disabled</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
  <div class="container mt-4">



    <h2>Formulario Aprendiz</h2>
    <form action="insertar.php" method="POST" enctype="multipart/form-data">
      <div class="mb-3">
        <label>ID</label>
        <input type="number" name="id" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Nombres</label>
        <input type="text" name="nombre" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Primer apellido</label>
        <input type="text" name="primer_apellido" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Segundo apellido</label>
        <input type="text" name="segundo_apellido" class="form-control">
      </div>
      <div class="mb-3">
        <label>Correo</label>
        <input type="email" name="correo" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Foto</label>
        <input type="file" name="foto" class="form-control">
      </div>
      <button type="submit" name="insertar" class="btn btn-success">Insertar</button>
    </form>

    <hr>

    <h2>Listado de Aprendices</h2>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Correo</th>
          <th>Foto</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $stmt = $conn->query("SELECT * FROM aprendices");
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
          <tr>
            <td><?= $fila['id'] ?></td>
            <td><?= $fila['nombres'] . ' ' . $fila['primer_apellido'] ?></td>
            <td><?= $fila['correo'] ?></td>
            <td><img src="../img/<?= $fila['foto'] ?>" width="60"></td>
            <td>
              <a href="editar.php?id=<?= $fila['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
              <a href="eliminar.php?id=<?= $fila['id'] ?>" class="btn btn-danger btn-sm"
                onclick="return confirm('¿Seguro que deseas eliminarlo?')">Eliminar</a>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>

  </div>
</body>

</html>