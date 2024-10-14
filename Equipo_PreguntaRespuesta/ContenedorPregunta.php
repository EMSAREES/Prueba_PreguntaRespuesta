<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Pregunta</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link href="/PreguntasRespuestas/css/contenedorpregunta.css" rel="stylesheet">
</head>
<body>

<!--------------------------------------Parte de Ricardo--------------------------------->

<div class="search-container">
    <!-- Flecha hacia atrás -->
    <div class="d-flex align-items-center mb-3">
        <i class="back-button bi bi-arrow-left"></i>
        <h1 class="ms-3">Preguntas</h1>
    </div>

    <!-- Barra de búsqueda -->
    <div class="input-group mb-3">
        <span class="input-group-text"><i class="bi bi-list"></i></span>
        <input type="text" class="form-control search-input" id="tag-input" placeholder="Añadir nueva etiqueta">
        <span class="input-group-text" id="add-tag-btn"><i class="bi bi-search"></i></span>
    </div>

    <!-- Contenedor de etiquetas dinámicas -->
    <div class="tag-container" id="tag-container">
        <div class="tag">
            Negocio <i class="bi bi-x" onclick="removeTag(this)"></i>
        </div>
        <div class="tag">
            Pytho <i class="bi bi-x" onclick="removeTag(this)"></i>
        </div>
        <button class="filter-btn">Reciente</button>
    </div>
</div>

<!-------------------------------------------Parte de Adan----------------------------------->
<?php


include($_SERVER['DOCUMENT_ROOT'] . '/PreguntasRespuestas/modelo/conexion.php');

$sql = "SELECT Id_Pregunta, Id_autor, id_Tema, Pregunta, Contexto, Hora, Fecha, Estado FROM pregunta";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class= 'container mt-5'>";
            echo "<div class='card-body'>";
                echo "<div class='row justify-content-between'>";
                    echo "<p class='card-text col-5'>Autor: " . $row["Id_autor"] . "</p>";
                    echo "<p class='card-text col-5 text-end'>" . $row["Hora"] . "</p>";
                    echo "<hr>";
                echo "</div>";
                echo "<p class='card-text'  style='margin-top: -3%;'><h2><B>" . $row["Pregunta"] . "</B></h2></p>";
                echo "<div class='row justify-content-between'>";
                    echo "<p class='card-text col-8'>" . $row["Contexto"] . "</p>";
                    echo "<button type='image' class='btn col-3' style='margin-top: -10%;' onclick='window.open('pregunta_detalle.php', '_blank')'>";
                        echo "<img id='eyeimg' src='https://cdn-icons-png.flaticon.com/512/159/159604.png' alt='' >";
                    echo "</button> ";
                echo "</div>";
            echo "</div>";
        echo "</div>";
    echo "</div>";
    }
} else {
    echo "0 resultados";
}
$conn->close();
?>
    






<!-- 


-->


    

    <!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<!-- Archivo JavaScript -->
<script src="script.js"></script>

</body>
</html>
    </div>
</body>
</html>