
<?php
// Datos de conexión a la base de datos (ajustar según tus credenciales de PHPMyAdmin)
// mysql://dajdgv8izdx4tcrh:cu32yzvacbwgml27@vvfv20el7sb2enn3.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306/sry1zz8n0zm8ltsz
$servername = "mysql://xu4iutboedgvynbs:dbnmaxejj796tnqd@ol5tz0yvwp930510.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306/c5a9uk6qm5d20vs5";
$username = "xu4iutboedgvynbs";
$password = "dbnmaxejj796tnqd";
$database = "c5a9uk6qm5d20vs5";

$puerto = 3306;
$hostname = "ol5tz0yvwp930510.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
/*$servername = "localhost";
$username = "root";
$password = "";
$dbname = "posterdb";*/ 

$conn = new mysqli($hostname, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connection was successfully established!";
?>

