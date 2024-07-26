<?php
session_start();



// Obtener el nombre del usuario
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Usuario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        .user-users-container {
            max-width: 600px;
            margin-top: 50px;
        }
    </style>
</head>
<body>

<div class="container user-users-container mt-5">
    <h1>Bienvenido, <?php echo htmlspecialchars($username); ?></h1>

    <!-- Contenido específico para usuarios normales -->
    <div class="text-center">
        <a href="logout.php" class="btn btn-danger mt-3">Cerrar sesión</a>
    </div>
    <!-- <a href="logout.php" class="btn btn-danger mt-3">Cerrar sesión</a> -->
</div>

<script>
        // Función para obtener parámetros de la URL
        function getUrlParameter(name) {
            name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
            var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
            var results = regex.exec(location.search);
            return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
        };

        // Obtener el mensaje y mostrarlo si existe
        document.addEventListener('DOMContentLoaded', function() {
            var msg = getUrlParameter('msg');
            var error_msg = getUrlParameter('error_msg');
            
            if (msg === 'success') {
                alert('Comentario guardado correctamente.');
            } else if (msg === 'error') {
                alert('Error al guardar el comentario: ' + error_msg);
            }
        });
    </script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="script.js"></script>

</body>
</html>
