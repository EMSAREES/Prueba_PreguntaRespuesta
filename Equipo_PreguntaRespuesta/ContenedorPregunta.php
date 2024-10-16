<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Pregunta</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

    <!--     No borrar   -->
    <link rel="stylesheet" href="css/contenedorpregunta.css">

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

// Realizamos un JOIN entre la tabla Pregunta y Usuario
$sql = "SELECT p.Id_Pregunta, 
               p.Pregunta, 
               p.Contexto, 
               p.Hora, 
               p.Fecha, 
               u.Nombre_Usu, 
               u.Apellidos_Usu
        FROM Pregunta p
        LEFT JOIN Usuario u ON p.Id_Autor = u.Id_Usu";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='container mt-4'>"; // Agregamos margen superior
            echo "<div class='card'>"; // Creamos una tarjeta para cada pregunta
                echo "<div class='card-body'>"; // Contenido de la tarjeta
                
                echo "<div class='d-flex justify-content-between align-items-center mb-2'>";
                    // Verificamos si el autor existe y mostramos "Anónimo" si es nulo o vacío
                    $autor = (!empty($row["Nombre_Usu"])) ? $row["Nombre_Usu"] . " " . $row["Apellidos_Usu"] : "Anónimo";
                    echo "<p class='card-text mb-0'><strong>Autor: </strong>" . $autor . "</p>";
                    echo "<p class='card-text mb-0'><small class='text-muted'>" . $row["Hora"] . "</small></p>";
                echo "</div>";
                
                echo "<h4 class='card-title'>" . $row["Pregunta"] . "</h4>"; // Título de la pregunta

                echo "<div Class='context-area col-8'>";
                echo "<p class='card-text scrollable-text'>" . $row["Contexto"] . "</p>"; // Contexto de la pregunta
                echo "</div>";
                
                echo "<div class='d-flex justify-content-end align-items-center'>"; // Botón de vista en el lado derecho
                    echo "<button class='btnEye btn' style='border: none; background: none;'>"; // Botón sin fondo
                        echo "<img class='imgEye' src='https://cdn-icons-png.flaticon.com/512/159/159604.png' alt='Ver detalle' style='width: 50px; height: 50px;'>"; // Imagen de ojo
                    echo "</button>";
                echo "</div>";

                echo "</div>"; // Fin de card-body
            echo "</div>"; // Fin de tarjeta (card)
        echo "</div>"; // Fin de contenedor
    }
} else {
    echo "0 resultados";
}

$conn->close();
?>


<script>
    // Seleccionamos todos los botones con la clase 'btnEye'
    document.querySelectorAll('.btnEye').forEach(button => {
        button.addEventListener('click', function() {
            // Cambiamos el color de fondo del botón clicado
            this.style.backgroundColor = "rgb(94, 229, 94)";
        });
    });
</script>



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