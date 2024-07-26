
<?php
// Datos de conexión a la base de datos (ajustar según tus credenciales de PHPMyAdmin)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "posterdb";

// Crear conexión
$mysqli = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}
?>

