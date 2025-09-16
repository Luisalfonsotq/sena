document.addEventListener('DOMContentLoaded', () => {
  // 1. Seleccionar los elementos del DOM que necesitamos
  const tableRows = document.querySelectorAll('tbody tr');
  const form = document.querySelector('form');
  const inputId = form.querySelector('input[name="id"]');
  const inputNombre = form.querySelector('input[name="nombre"]');
  const inputPrimerApellido = form.querySelector('input[name="primer_apellido"]');
  const inputSegundoApellido = form.querySelector('input[name="segundo_apellido"]');
  const inputCorreo = form.querySelector('input[name="correo"]');
  const inputFoto = form.querySelector('input[name="foto"]');

  const insertarBtn = document.getElementById('insertarBtn');
  const actualizarBtn = document.getElementById('actualizarBtn');
  const cancelarBtn = document.getElementById('cancelarBtn');

  // Almacenamos la URL de inserción original
  const originalAction = form.action;

  // 2. Función para resetear el formulario y los botones
  const resetForm = () => {
    form.reset();
    insertarBtn.style.display = 'inline';
    actualizarBtn.style.display = 'none';
    form.action = originalAction;
  };

  // 3. Agregar el evento de clic a cada fila de la tabla
  tableRows.forEach(row => {
    row.addEventListener('click', () => {
      const cells = row.querySelectorAll('td');

      // 4. Asegurarse de que tenemos suficientes celdas
      if (cells.length >= 6) {
        // Llenar los campos del formulario
        inputId.value = cells[0].textContent;
        inputNombre.value = cells[1].textContent;
        inputPrimerApellido.value = cells[2].textContent;
        inputSegundoApellido.value = cells[3].textContent;
        inputCorreo.value = cells[4].textContent;
        inputFoto.value = cells[5].textContent;

        // 5. Cambiar el estado del formulario a "actualizar"
        form.action = './modificar.php'; // Apunta el formulario a modificar.php
        insertarBtn.style.display = 'none'; // Oculta el botón de insertar
        actualizarBtn.style.display = 'inline'; // Muestra el botón de actualizar
      } else {
        console.error("La fila no tiene la cantidad de celdas esperada.");
      }
    });
  });

  // 6. Agregar un evento al botón Cancelar para resetear
  cancelarBtn.addEventListener('click', (event) => {
    event.preventDefault(); // Evita que el formulario se envíe
    resetForm();
  });
});