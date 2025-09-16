document.addEventListener('DOMContentLoaded', () => {
    // CORRECCIÓN: Usar querySelector para obtener el primer elemento con la clase 'foto'
    const fotoInput = document.querySelector('.foto');
    const previewImage = document.getElementById('preview-image');

    fotoInput.addEventListener('change', function(event) {
        const file = event.target.files[0];
        
        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewImage.style.display = 'block'; // Muestra la imagen una vez cargada
            };

            reader.readAsDataURL(file); // Lee el archivo como una URL de datos Base64
        } else {
            // Oculta la imagen si el usuario cancela la selección
            previewImage.src = '#';
            previewImage.style.display = 'none';
        }
    });
});