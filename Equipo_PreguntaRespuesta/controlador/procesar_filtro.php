<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sistemajornada";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el filtro desde la URL
$filter = isset($_GET['filter']) ? $_GET['filter'] : '';
$filterArray = explode(',', $filter);

// Base de la consulta
$sql = "SELECT Id_Pregunta, Id_autor, id_Tema, Pregunta, Contexto, Hora, Fecha, Estado FROM pregunta WHERE 1=1";

// Aplicar filtro si hay etiquetas
if (!empty($filterArray)) {
    foreach ($filterArray as $filtro) {
        $filtro = trim($filtro);
        if (!empty($filtro)) {
            $sql .= " AND (Pregunta LIKE '%$filtro%' OR Contexto LIKE '%$filtro%')";
        }
    }
}

$result = $conn->query($sql);

// Mostrar resultados
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='container mt-5'>";
            echo "<div class='card-body'>";
                echo "<div class='row justify-content-between'>";
                    echo "<p class='card-text col-5'>Autor: " . $row["Id_autor"] . "</p>";
                    echo "<p class='card-text col-5 text-end'>" . $row["Hora"] . "</p>";
                    echo "<hr>";
                echo "</div>";
                echo "<p class='card-text'  style='margin-top: -3%;'><h2><B>" . $row["Pregunta"] . "</B></h2></p>";
                echo "<div class='row justify-content-between'>";
                    echo "<p class='card-text col-8'>" . $row["Contexto"] . "</p>";
                    echo "<button type='button' class='btn col-3' style='margin-top: -10%;' onclick=\"window.open('pregunta_detalle.php', '_blank')\">";
                        echo "<img id='eyeimg' src='https://cdn-icons-png.flaticon.com/512/159/159604.png' alt='Ver Detalle'>";
                    echo "</button>";
                echo "</div>";
            echo "</div>";
        echo "</div>";
    }
} else {
    echo "<p>No se encontraron resultados.</p>";
}

$conn->close();
?>
