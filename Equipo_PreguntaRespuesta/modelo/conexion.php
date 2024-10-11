<?php
// Datos de conexión (reemplázalos con tus propios datos)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sistemajornada";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
} /*else {
    echo "Conexión exitosa";
}*/
?>