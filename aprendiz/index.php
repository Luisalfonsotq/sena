<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRUD Aprendiz SENA</title>
  <link rel="stylesheet" href="../css/bootstrap.css">
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>
  <div class="container bg-light pt-4 d-flex-center">
    <form action="./insertar.php" method="POST" enctype="multipart/form-data" class="form-floating mb-3">
      <h2>Formulario Aprendiz</h2>

      <div class="mb-3 rounded form-floating">
        <input type="number" class="form-control" id="floatingInput" name="id" placeholder="" required>
        <label class="form-label" for="floatingInput">ID</label>
      </div>

      <div class="mb-3 rounded form-floating">
        <input type="text" class="form-control" id="floatingInput" name="nombre" placeholder="" required>
        <label class="form-label" for="floatingInput">Nombres</label>
      </div>

      <div class="mb-3 form-floating">
        <input type="text" class="form-control" id="floatingInput" name="primer_apellido" placeholder="" required>
        <label class="form-label" for="floatingInput">Primer apellido</label>
      </div>

      <div class="mb-3 form-floating">
        <input type="text" class="form-control" id="floatingInput" name="segundo_apellido" placeholder="">
        <label class="form-label" for="floatingInput">Segundo apellido</label>
      </div>

      <div class="mb-3 form-floating">
        <input type="email" class="form-control" id="floatingInput" name="correo" placeholder="name@example.com"
          required>
        <label class="form-label" for="floatingInput">Correo</label>
      </div>

      <div class="mb-3 form-floating">
        <input type="file" class="form-control foto" id="floatingInput" name="foto" placeholder="URL de tu foto">
        <label class="form-label" for="floatingInput">Foto</label>
      </div>

      <div class="mb-3 d-flex justify-content-center">
        <img id="preview-image" src="#" alt="Vista previa de la foto"
          style="max-width: 500px; max-height: 200px; border: 1px solid #ccc; display: none;">
      </div>

      <div class="pb-2">
        <button type="submit" class="btn btn-success" id="insertarBtn" name="insertar">Insertar</button>

        <button type="submit" class="btn btn-secondary" id="actualizarBtn" name="actualizar"
          style="display:none;">Actualizar</button>

        <button type="reset" class="btn btn-warning" id="cancelarBtn">Cancelar</button>
      </div>
    </form>

    <h2>Listado de Aprendices</h2>

    <?php
    require_once "./obtener.php";
    $aprendices = listaAprendices();
    if ($aprendices) {
      // Generar tabla
      echo "<table class='table table-bordered border-primary table-hover'>";
      echo "<thead class='table-primary table-bordered border-primary'><tr>";
      $keys = array_keys($aprendices[0]);
      foreach ($keys as $header) {
        echo "<th>" . htmlspecialchars(ucfirst($header)) . "</th>";
      }

      // Agregamos una columna para las acciones de Eliminar
      echo "<th>Acciones</th>";
      echo "</tr></thead>";

      echo "<tbody>";
      foreach ($aprendices as $aprendiz) {
        // La fila es ahora clickeable para activar el formulario de edición
        echo "<tr>";
        foreach ($aprendiz as $campo) {
          echo "<td>" . htmlspecialchars($campo) . "</td>";
        }

        // Formulario solo para ELIMINAR con alerta de confirmación
        echo "<td>";
        echo "<form action='eliminar.php' method='POST' style='display:inline; margin-left: 5px;'>";
        echo "<input type='hidden' name='id' value='" . htmlspecialchars($aprendiz['id']) . "'>";
        // Aquí se agrega el 'onclick' con la alerta
        echo "<button type='submit' class='btn btn-danger btn-sm' onclick=\"return confirm('¿Estás seguro de que quieres eliminar este registro?');\">Eliminar</button>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
      }

      echo "</tbody>";
      echo "</table>";
    } else {
      echo "<p>No se encontraron aprendices en la base de datos.</p>";
    }
    ?> 
  </div>
  <script src="../js/bootstrap.js"></script>
  <script src="../js/code.js"></script>
  <script src="../js/preview.js"></script>
</body>

</html>
