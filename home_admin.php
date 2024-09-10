<?php
session_start(); 

// Verificar si el usuario tiene sesión y es administrador
// if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Admin') {
//     header("location: index.php");
//     exit;
// }

// Incluir el archivo de configuración de la base de datos
include_once 'home_admin_view.php';
require_once 'config.php';

// Mensajes de éxito o error al procesar la publicación
$message = '';
$error_c = '';
$error_s = '';

$userId = '1'; // Este es un ejemplo; en una implementación real, deberías obtener el ID del usuario desde la sesión

// Procesar el formulario de nueva publicación si se envió
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validar título y contenido
    if (empty($_POST['postTitle'])) {
        $error = 'El título es obligatorio.';
    } elseif (empty($_POST['postContent'])) {
        $error = 'El contenido es obligatorio.';
    } else {
        $postTitle = $_POST['postTitle'];
        $postContent = $_POST['postContent'];
        
        // Validar imagen si se subió
        if (isset($_FILES['postImage']) && $_FILES['postImage']['error'] === UPLOAD_ERR_OK) {
            $imageTmpName = $_FILES['postImage']['tmp_name'];
            $imageData = file_get_contents($imageTmpName); // Leer los datos binarios del archivo
            $imageMimeType = mime_content_type($imageTmpName); // Obtener el tipo MIME del archivo
        } else {
            $imageData = null;
        }

        $currentDateShort = date('d-m-Y');
        
        // Insertar la publicación en la base de datos
        if ($imageData !== null) {
            $sql = "INSERT INTO post (titulo, poster, fecha, imagen, user_id) VALUES (?, ?, ?, ?, ?)";
            if ($stmt = $mysqli->prepare($sql)) {
                $stmt->bind_param("sssss", $postTitle, $postContent, $currentDateShort, $imageData, $userId);
            }
        } else {
            $sql = "INSERT INTO post (titulo, poster, fecha, user_id) VALUES (?, ?, ?, ?)";
            if ($stmt = $mysqli->prepare($sql)) {
                $stmt->bind_param("ssss", $postTitle, $postContent, $currentDateShort, $userId);
            }
        }
        $message = "se ha creado correctamente.";
        $error_c = $stmt->error;
        $error_s = $mysqli->error;
        if ($stmt) {
            if ($stmt->execute()) {
                echo "</div>";
                echo "<div class='card bg-success text-white mt-4' style='max-width: 300px; margin: 0 auto; font-size: 12px; padding: 0px;'>";
                echo "<div class='card-body'>";
                echo "La publicacion " .$message;
                echo "</div>";
                echo "</div>";
                echo "</div>";
            } else {
                echo "</div>";
                echo "<div class='card bg-danger text-white mt-4' style='max-width: 300px; margin: 0 auto; font-size: 12px; padding: 0px;'>";
                echo "<div class='card-body'>";
                echo"Error al crear la publicacion:  " .$error_c;
                echo "</div>";
                echo "</div>";
                echo "</div>";
                
                //$error = "Error al crear la publicación: " . $stmt->error;
            }
            $stmt->close();
        } else {
                echo "</div>";
                echo "<div class='card bg-danger text-white mt-4' style='max-width: 300px; margin: 0 auto; font-size: 12px; padding: 0px;'>";
                echo "<div class='card-body'>";
                echo"Error al crear la publicacion:  " .$error_s;
                echo "</div>";
                echo "</div>";
                echo "</div>";
            
            //$error = "Error de preparación de la consulta: " . $mysqli->error_s;
        }
    }
}
?>

