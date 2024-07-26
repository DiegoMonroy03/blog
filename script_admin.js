document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('postForm').addEventListener('submit', async function (event) {
        event.preventDefault(); // Evita el envío automático del formulario

        var postTitle = document.getElementById('postTitle').value;
        var postContent = document.getElementById('postContent').value;
        var postImage = document.getElementById('postImage').files[0];

        // Validación de campos obligatorios
        if (!postTitle || !postContent) {
            alert('Por favor, completa todos los campos obligatorios.');
            return;
        }

        // Validación del archivo de imagen si se selecciona
        if (postImage) {
            var validImageTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!validImageTypes.includes(postImage.type)) {
                alert('Por favor, sube una imagen en formato JPEG, PNG o GIF.');
                return;
            }
            if (postImage.size > 5 * 1024 * 1024) { // 5 MB
                alert('El tamaño de la imagen no debe exceder los 5 MB.');
                return;
            }
        }

        // Preparar datos del formulario para enviar
        var formData = new FormData();
        formData.append('postTitle', postTitle);
        formData.append('postContent', postContent);
        if (postImage) {
            formData.append('postImage', postImage);
        }

        try {
            // Enviar datos al servidor
            let response = await fetch('home_admin.php', {
                method: 'POST',
                body: formData
            });

            let result = await response.json();

            if (response.ok) {
                // Redirigir a home_admin_view.php con mensaje de éxito
                window.location.href = `home_admin_view.php?message=${encodeURIComponent(result.message)}`;
            } else {
                // Redirigir a home_admin_view.php con mensaje de error
                window.location.href = `home_admin_view.php?error=${encodeURIComponent(result.error)}`;
            }
        } catch (error) {
            alert('Error de conexión: ' + error.message);
        }
    });
});





